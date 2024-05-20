<div class="row flex justify-center my-1 py-1">
    <form class="max-w-sm mx-auto">
        @foreach ($board as $key => $row)
            <label for="number-input-{{ $key }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $row->problem }}</label>
            <input wire:model.live="answers.{{ $key }}" type="number" id="number-input-{{ $key }}" class="block w-full p-2.5 @if (array_key_exists($key, $correctAnswers)) bg-green-50 border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-green-500 @else bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @endif" placeholder="Answer {{ $row->answer }}" required  @if (array_key_exists($key, $correctAnswers)) disabled @endif/>
            @error('answers.'.$key)
                <span class="error">{{ $message }}</span>
            @enderror
        @endforeach
    </form>
</div>
