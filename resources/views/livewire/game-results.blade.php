<div class="grid grid-cols-3 grid-gap-4 my-4 p-4 text-center @if ($hidden) hidden @endif">
    <div class="col-span-3">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">{{ __('Game Results')}}</h1>
    </div>
    <div class="col-span-3">
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
            Congratulations! You finished the game in {{ $secondsPassed }} seconds. You solved {{ $correctAnswersCount }} problems.
        </p>
    </div>
    <div>
        <h3 class="text-3xl font-bold dark:text-white">{{ __('Time')}}:</h3>
        <h4 class="text-2xl font-bold dark:text-white">{{ $secondsPassed }} s</h4>
    </div>
    <div>
        <h3 class="text-3xl font-bold dark:text-white">{{ __('Problems solved')}}:</h3>
        <h4 class="text-2xl font-bold dark:text-white">{{ $correctAnswersCount }}</h4>
    </div>
    <div>
        <h3 class="text-3xl font-bold dark:text-white">{{ __('Game Mode')}}:</h3>
        <h4 class="text-2xl font-bold dark:text-white">{{ $gameMode }}</h4>
    </div>

    <div class="col-span-1 mt-10">
        <h5 class="text-3xl font-bold dark:text-white">{{ __('Solved problems')}}:</h3>
    </div>

    <div class="col-span-3 grid grid-cols-12 text-left mt-4">
        @foreach ($solvedProblems as $solvedProblem)
            <div class="col-span-1">
                <p class="text-xs text-gray-900 dark:text-white">{{ $solvedProblem }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-subgrid gap-4 col-span-3 mt-4">
        <div class="col-start-2">
            <button @click="$dispatch('restartGame')" type="button" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">{{ __('Play Again') }}</button>
        </div>
    </div>
</div>
