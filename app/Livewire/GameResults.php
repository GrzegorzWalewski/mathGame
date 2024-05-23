<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class GameResults extends Component
{
    public int $correctAnswersCount = 0;
    public int $secondsPassed = 0;
    public string $gameMode = '';

    public bool $hidden = true;

    public array $solvedProblems = [];

    public function render()
    {
        return view('livewire.game-results');
    }

    #[On('gameCompleted')]
    public function setData(int $correctAnswersCount, int $secondsPassed, bool $timeMode, array $solvedProblems)
    {
        $this->correctAnswersCount = $correctAnswersCount;
        $this->secondsPassed = $secondsPassed;
        $this->gameMode = $timeMode ? 'time' : 'quantity';
        $this->solvedProblems = $solvedProblems;
        $this->hidden = false;
    }

    #[On('gameSettingsChanged')]
    public function hide()
    {
        $this->hidden = true;
    }
}
