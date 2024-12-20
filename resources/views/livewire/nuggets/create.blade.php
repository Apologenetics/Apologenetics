<div class="flex flex-col space-y-4 w-full p-8 rounded-xl">
    @if ($includeTitle)
        <!-- Title & Type -->
        <div class="flex flex-row space-x-4 w-full">
            <h3 class="text-2xl font-bold text-sky-900 dark:text-sky-700">{{ $model->title }}</h3>
        </div>
    @endif
    @if (isset($state['message']))
        <div
            class="w-full p-4 bg-gray-300 dark:bg-gray-500 ring-1 ring-gray-500 rounded-lg flex flex-row items-center justify-between">
            <span class="text-md text-gray-700 dark:text-gray-500">{{ $state['message'] }}</span>
            <button class="w-6 h-6 rounded-full justify-center text-gray-500 bg-gray-800 font-bold">X</button>
        </div>
    @endif
    <!-- Controls -->
    <div class="flex flex-row space-x-4 w-full">
        <!-- Nugget Type -->
        <div class="flex flex-col space-y-2">
            <select id="type" wire:model.defer="state.type" class="rounded-xl dark:bg-gray-600 dark:text-white">
                @forelse(\App\Models\Nugget::NUGGET_TYPES as $key => $nuggetType)
                    <option value="{{ $key }}">{{ ucwords($nuggetType) }}</option>
                @empty
                    <option></option>
                @endforelse
            </select>
        </div>
    </div>
    <!-- Title -->
    <div class="flex flex-col space-y-2">
        <label for="title" class="text-md font-semibold text-black dark:text-white">Title</label>
        <input type="text" id="title"
            class="w-full rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-white p-2 border-none"
            wire:model.defer="state.title" />
    </div>
    <!-- Content -->
    <div class="flex flex-col space-y-2">
        <label for="content" class="text-md font-semibold text-black dark:text-white">Content</label>
        <textarea rows="5" type="text" id="content"
            class="w-full rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-white p-2 border-none"
            wire:model.defer="state.content"></textarea>
    </div>
    <!-- Submit -->
    <div class="flex flex-row justify-end">
        <x-button wire:click="submit">Submit</x-button>
    </div>
</div>
