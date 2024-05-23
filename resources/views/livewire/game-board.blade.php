<div class="row grid grid-cols-1 my-1 p-4 @if ($hidden) hidden @endif">
    <div class="grid grid-cols-6 mx-auto p-2">
        {{-- counter --}}
        <div class="col-span-1">
            @if ($timer->getStatus() === 'running')
                @if ($timeMode)
                    <p class="mb-3 rtl:text-left text-gray-500 dark:text-gray-400" wire:poll.visible.1s="checkTime">{{ $gameModeValue - $timer->getSecondsPassed() }} s</p>
                @else
                    <p class="mb-3 rtl:text-left text-gray-500 dark:text-gray-400"> {{ $correctAnswersCount }} / {{ $gameModeValue }} </p>
                @endif
            @endif
        </div>

        {{-- modificators --}}
        <div class="col-span-5"></div>
    </div>
    <div class="my-1 py-1">
        <form class="mx-auto grid grid-cols-3 gap-4 p-4">
            <div class="blur">
                <label for="number-input-success" class="transition transform duration-100 ease-in-out @if ($correctAnswersCount < 1) hidden @endif block mb-2 text-sm font-medium text-green-700 dark:text-green-500">{{ $currentProblem }}</label>
                <input type="number" id="number-input-success" class="transition transform duration-100 ease-in-out @if ($correctAnswersCount < 1) hidden @endif bg-green-50 border border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-green-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Answer" disabled/>
            </div>
            <div>
                <label for="number-input" class="transition transform- duration-100 ease-in-out block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $currentProblem }}</label>
                <input wire:keyup="checkAnswer" wire:model.live="answer" type="number" id="number-input" class="transition transform duration-100 ease-in-out block w-full p-2.5 bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Answer" required/>
            </div>
            <div class="blur">
                <label for="number-input-waiting" class="transition transform duration-100 ease-in-out block mb-2 text-sm font-medium text-purple-700 dark:text-purple-600">{{ $currentProblem }}</label>
                <input type="number" id="number-input-waiting" class="transition transform duration-100 ease-in-out block w-full p-2.5 bg-purple-50 border-purple-500 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Answer" disabled/>
            </div>
        </form>
    </div>
</div>