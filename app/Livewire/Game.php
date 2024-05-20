<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Game extends Component
{
    public $gameTypeId = 1;

    public $completed = false;

    public function render()
    {
        return view('livewire.game');
    }

    public function setGameType($gameTypeId)
    {
        $this->gameTypeId = $gameTypeId;
        $this->dispatch('gameTypeSelected');
    }

    #[On('gameCompleted')]
    #[On('gameTypeSelected')]
    public function gameCompleted()
    {
        $this->completed = !$this->completed;
    }
}
