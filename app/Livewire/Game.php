<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Mode;

class Game extends Component
{
    public int $gameTypeId = 1;

    public int $gameModeId = 1;

    public int $gameModeValue = 15;

    public bool $completed = false;

    public function render()
    {
        return view('livewire.game');
    }

    public function setGameType($gameTypeId)
    {
        $this->gameTypeId = $gameTypeId;
        $this->dispatch('restartGame');
    }

    public function setGameMode($gameModeId)
    {
        $this->gameModeId = $gameModeId;
        $mode = Mode::find($gameModeId);
        $this->setGameModeValue($mode->defaultValue());
    }

    public function setGameModeValue($gameModeValue)
    {
        $this->gameModeValue = $gameModeValue;
        $this->dispatch('restartGame');
    }

    #[On('gameCompleted')]
    public function gameCompleted()
    {
        $this->completed = true;
    }

    #[On('restartGame')]
    public function resetGame()
    {
        $this->completed = false;
    }
}
