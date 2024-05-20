<?php

namespace App\Livewire;

use App\Services\ProblemGenerator;
use Livewire\Component;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\On;

class GameBoard extends Component
{
    public const DEFAULT_PROBLEMS_COUNT = 3;
    #[Reactive]
    public int $gameTypeId;

    public array $answers;

    public int $correctAnswersCount = 0;

    public string $currentProblem;

    public array $board = [];

    private ProblemGenerator $problemGeneratorService;

    #[On('gameSettingsChanged')]
    public function updateBoard()
    {
        $this->reset(['answers', 'correctAnswers']);
        $this->resetErrorBag();
        $this->board = $this->generateProblems(self::DEFAULT_PROBLEMS_COUNT);
    }

    public function updatedAnswers($value, $key)
    {
        $firstProblem = reset($this->board);
        $this->resetErrorBag('answers.' . $key);
        
        if ($firstProblem->answer == $value) {
            $this->correctAnswersCount++;
            array_shift($this->board);
            $this->reset(['answers']);

            // TODO: use values from settings
            $timeMode = true;
            $limitQty = 5;

            if ($timeMode || $this->correctAnswersCount == $limitQty - self::DEFAULT_PROBLEMS_COUNT) {
                $this->board = array_merge($this->board, $this->generateProblems(1));
            } elseif (count($this->board) == 0) {
                $this->dispatch('gameCompleted');
            }
        } else {
            $this->addError('answers.' . $key, 'Wrong answer');
        }
    }

    public function render()
    {
        if (empty($this->board)) {
            $this->board = $this->generateProblems(self::DEFAULT_PROBLEMS_COUNT);
        }

        return view('livewire.game-board');
    }

    public function generateProblems(int $count): array
    {
        $this->problemGeneratorService = new ProblemGenerator($this->gameTypeId);

        $board = [];

        for ($i = 0; $i < $count; $i++) {
            $board[] = $this->problemGeneratorService->generateProblem();
        }

        return $board;
    }
}
