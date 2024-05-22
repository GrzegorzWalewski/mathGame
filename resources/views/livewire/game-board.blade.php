<div class="row flex justify-center my-1 py-1">
    <h1>Game Board</h1>
    @if ($timer->getStatus() === 'running')
        Time: <span wire:poll.visible.1s>{{ $timer->getSecondsPassed() }}</span>
    @endif
    <form class="max-w-sm mx-auto">
        @foreach ($board as $key => $row)
            <label for="number-input-{{ $key }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $row->problem }}</label>
            <input wire:model.live="answers.{{ $key }}" type="number" id="number-input-{{ $key }}" class="block w-full p-2.5 bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Answer {{ $row->answer }}" required/>
        @endforeach
    </form>
</div>
