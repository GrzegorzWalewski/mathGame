<div>
    <livewire:game-menu :$gameTypeId />
    @if (!$completed)
        <livewire:game-board :$gameTypeId />
    @else
        <livewire:game-results />
    @endif
</div>
