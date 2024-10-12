<div class="p-8 flex flex-col w-full space-y-4 rounded-2xl shadow-2xl">
    @if (isset($entity))
        <p class="font-bold text-3xl text-black dark:text-white">{{ $entity->title }}</p>
    @endif

    <div class="flex flex-col md:flex-row gap-4 w-full max-w-2xl">
        <div class="flex flex-col space-y-2 w-full">
            <label for="religion_id" class="font-semibold text-xl text-black dark:text-white">Religion</label>
            <select id="religion_id" wire:model="state.religion_id" class="rounded-xl dark:bg-gray-600 dark:text-white">
                @forelse ($religions as $religion)
                    <option value="{{ $religion->getKey() }}">{{ $religion->name }}</option>
                @empty
                    <option disabled>No religions available</option>
                @endforelse
            </select>
        </div>

        <div class="flex flex-col space-y-2 w-full">
            <label for="denomination_id" class="font-semibold text-xl text-black dark:text-white">Denomination</label>
            <select id="denomination_id" wire:model="state.denomination_id"
                class="rounded-xl dark:bg-gray-600 dark:text-white">
                <option value="0" selected>None</option>
                @foreach ($denominations ?? [] as $denomination)
                    <option value="{{ $denomination->getKey() }}">{{ $denomination->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <label for="title" class="font-semibold text-xl text-black dark:text-white">Title</label>
    <input id="title" type="text"
        class="w-full rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-white p-2 border-none"
        wire:model.defer="state.title">

    <label for="description" class="font-semibold text-xl text-black dark:text-white">Description</label>
    <textarea wire:model.defer="state.description"
        class="rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-white p-2 border-none" rows="5"></textarea>

    <div class="w-full flex justify-end">
        <x-button wire:click="submit">
            <svg wire:loading wire:target="submit" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            Submit
        </x-button>
    </div>
</div>
