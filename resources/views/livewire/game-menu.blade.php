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
        <a wire:click.prevent="$parent.setGameType({{ $gametype->id }})" href="#{{ $gametype->name }}" class="px-1 font-medium mx-1 @if ($gametype->id == $gameTypeId) text-blue-600 dark:text-blue-500 @else text-blue-300 dark:text-blue-200  @endif">{{ $gametype->symbol }}</a>
    @endforeach
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
    </svg>
    {{-- modes --}}
    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">Read more</a>
    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">Read more</a>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
    </svg>
    {{-- sub-modes --}}
    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">Read more</a>
    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">Read more</a>
</div>