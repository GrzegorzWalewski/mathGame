<div class="row flex justify-center my-1 py-1">
    {{-- modificators --}}
    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">Read more</a>
    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">Read more</a>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
    </svg>
    {{-- gametypes --}}
    @foreach ($gameTypes as $gametype)
        <a wire:click.prevent="$parent.setGameType({{ $gametype->id }})" href="#" class="px-1 font-medium mx-1 @if ($gametype->id == $gameTypeId) text-blue-600 dark:text-blue-500 @else text-blue-300 dark:text-blue-200  @endif">{{ $gametype->symbol }}</a>
    @endforeach
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
    </svg>
    {{-- modes --}}
    @foreach ($gameModes as $mode)
        <a wire:click.prevent="$parent.setGameMode({{ $mode->id }})" href="#" class="px-1 font-medium mx-1 @if ($mode->id == $gameModeId) text-blue-600 dark:text-blue-500 @else text-blue-300 dark:text-blue-200  @endif">{{ $mode->name }}</a>
    @endforeach
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
    </svg>
    {{-- sub-modes --}}
    @foreach ($gameModeValues as $key => $name)
        <a wire:click.prevent="$parent.setGameModeValue({{ $key }})" href="#" class="px-1 font-medium mx-1 @if ($key == $gameModeValue) text-blue-600 dark:text-blue-500 @else text-blue-300 dark:text-blue-200  @endif">{{ $name }}</a>
    @endforeach
</div>