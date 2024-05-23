<?php

namespace App\Livewire;

use App\Models\GameType;
use App\Models\Mode;
use Livewire\Component;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\On;

class GameMenu extends Component
{
    #[Reactive]
    public int $gameTypeId;

    #[Reactive]
    public int $gameModeId;

    #[Reactive]
    public int $gameModeValue;

    public bool $hidden = false;

    public function render()
    {
        $gameTypes = GameType::all();
        $gameModes = Mode::all();
        $gameModeValues = Mode::find($this->gameModeId)->values();

        return view('livewire.game-menu', compact('gameTypes', 'gameModes', 'gameModeValues'));
    }

    #[On('gameCompleted')]
    public function hide()
    {
        $this->hidden = true;
    }

    #[On('restartGame')]
    public function show()
    {
        $this->hidden = false;
    }
}
