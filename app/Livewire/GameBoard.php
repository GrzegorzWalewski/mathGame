<?php

namespace App\Livewire;

use App\Services\ProblemGenerator;
use App\Timer;
use Livewire\Component;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\On;
use App\Models\Mode;

class GameBoard extends Component
{
    public const DEFAULT_PROBLEMS_COUNT = 3;

    #[Reactive]
    public int $gameTypeId;

    #[Reactive]
    public int $gameModeId;

    #[Reactive]
    public int $gameModeValue;

    public Timer $timer;

    public array $answers;

    public int $correctAnswersCount = 0;

    public string $currentProblem;

    public array $board = [];

    public bool $timeMode = false;

    private ProblemGenerator $problemGeneratorService;

    public function mount()
    {
        $this->timer = new Timer();
    }

    #[On('gameSettingsChanged')]
    public function updateBoard()
    {
        $this->timeMode = Mode::find($this->gameModeId)->name === 'time';
        $this->reset(['answers', 'correctAnswersCount']);
        $this->board = $this->generateProblems(self::DEFAULT_PROBLEMS_COUNT);
    }

    public function updatedAnswers($value, $key)
    {
        $this->checkTime();
        $firstProblem = reset($this->board);
        $this->resetErrorBag('answers.' . $key);
        
        if ($firstProblem->answer == $value) {
            $this->correctAnswersCount++;
            array_shift($this->board);
            $this->reset(['answers']);

            if ($this->timeMode || (!$this->timeMode && $this->correctAnswersCount <= $this->gameModeValue - self::DEFAULT_PROBLEMS_COUNT)) {
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

    private function checkTime()
    {
        if ($this->timer->getStatus() === Timer::STATUS_STOPPED) {
            $this->timer->start();
        }

        $secondsPassed = $this->timer->getSecondsPassed();
        if ($this->timeMode && $secondsPassed >= $this->gameModeValue) {
            $this->dispatch('gameCompleted');
        }
    }
}
