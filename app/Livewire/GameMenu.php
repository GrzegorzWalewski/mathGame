<?php

namespace App\Livewire;

use App\Models\GameType;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class GameMenu extends Component
{
    #[Reactive]
    public int $gameTypeId;

    public function render()
    {
        $gameTypes = GameType::all();

        return view('livewire.game-menu', compact('gameTypes'));
    }
}
