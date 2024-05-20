<div>
    <livewire:game-menu :$gameTypeId :$gameModeId :$gameModeValue />
    @if (!$completed)
        <livewire:game-board :$gameTypeId :$gameModeId :$gameModeValue/>
    @else
        <livewire:game-results />
    @endif
</div>
