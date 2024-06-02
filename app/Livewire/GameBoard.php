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

    public ?float $answer = null;

    public int $correctAnswersCount = 0;

    public string $currentProblem;

    public array $board = [];

    public bool $timeMode;

    public bool $hidden = false;

    public array $solvedProblems = [];

    private ProblemGenerator $problemGeneratorService;

    public function mount()
    {
        $this->timer = new Timer();
    }

    public function render()
    {
        if (empty($this->board)) {
            $this->updateBoard();
        }

        return view('livewire.game-board');
    }

    public function checkAnswer()
    {
        $this->checkTime();
        $firstProblem = reset($this->board);
        
        if ($this->answer && $firstProblem->answer == $this->answer) {
            $this->correctAnswersCount++;
            $this->solvedProblems[] = str_replace('?', $firstProblem->answer, $firstProblem->problem);
            array_shift($this->board);
            $this->reset(['answer']);
            
            if (count($this->board) == 0) {
                $this->finishGame();

                return;
            }

            if ($this->timeMode || (!$this->timeMode && $this->correctAnswersCount <= $this->gameModeValue - self::DEFAULT_PROBLEMS_COUNT)) {
                $this->board = array_merge($this->board, $this->generateProblems(1));
            }

            $this->currentProblem = reset($this->board)->problem;
        } else {
            $this->addError('answer', 'Wrong answer');
        }
    }

    public function checkTime()
    {
        if ($this->timer->getStatus() === Timer::STATUS_STOPPED) {
            $this->timer->start();
        }

        $secondsPassed = $this->timer->getSecondsPassed();
        if ($this->timeMode && $secondsPassed >= $this->gameModeValue) {
            $this->finishGame();
        }
    }

    #[On('restartGame')]
    public function updateBoard()
    {
        $this->timer->stop();
        $this->hidden = false;
        $this->timeMode = Mode::find($this->gameModeId)->name === 'time';
        $this->reset(['answer', 'correctAnswersCount', 'solvedProblems']);
        $this->board = $this->generateProblems(self::DEFAULT_PROBLEMS_COUNT);
        $this->currentProblem = reset($this->board)->problem;
    }

    private function generateProblems(int $count): array
    {
        $this->problemGeneratorService = new ProblemGenerator($this->gameTypeId);

        $board = [];

        for ($i = 0; $i < $count; $i++) {
            $board[] = $this->problemGeneratorService->generateProblem();
        }

        return $board;
    }

    private function finishGame()
    {
        $this->hidden = true;
        $this->dispatch('gameCompleted', correctAnswersCount: $this->correctAnswersCount, secondsPassed: $this->timer->getSecondsPassed(), timeMode: $this->timeMode, solvedProblems: $this->solvedProblems);
    }

    #[On('gameCompleted')]
    public function hide()
    {
        $this->hidden = true;
    }
}
