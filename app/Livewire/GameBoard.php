<?php

namespace App\Livewire;

use App\Services\ProblemGenerator;
use Livewire\Component;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\On;

class GameBoard extends Component
{
    #[Reactive]
    public int $gameTypeId;

    public array $answers;

    public array $correctAnswers;

    public array $board = [];

    private ProblemGenerator $problemGeneratorService;

    #[On('gameSettingsChanged')]
    public function updateBoard()
    {
        $this->reset(['answers', 'correctAnswers']);
        $this->resetErrorBag();
        $this->board = $this->generateBoard();
    }

    public function updatedAnswers($value, $key)
    {
        $allCorrect = true;

        foreach ($this->board as $key => $problem) {
            $this->resetErrorBag('answers.' . $key);

            if (!array_key_exists($key, $this->answers)) {
                $allCorrect = false;

                continue;
            }

            if ($this->answers[$key] == $problem->answer) {
                $this->correctAnswers[$key] = true;
            } else {
                $this->addError('answers.' . $key, 'Wrong answer');

                $allCorrect = false;
            }
        }

        if ($allCorrect) {
            $this->dispatch('gameCompleted');
        }
    }

    public function render()
    {
        if (empty($this->board)) {
            $this->board = $this->generateBoard();
        }

        return view('livewire.game-board');
    }

    public function generateBoard(): array
    {
        $this->problemGeneratorService = new ProblemGenerator($this->gameTypeId);
        $problemsCount = 5; // TODO: get from settings

        $board = [];

        for ($i = 0; $i < $problemsCount; $i++) {
            $board[] = $this->problemGeneratorService->generateProblem();
        }

        return $board;
    }
}
