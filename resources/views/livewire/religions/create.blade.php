<div class="flex flex-col space-y-4 p-8 w-full">
    <!-- Row 1 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
        <!-- Name -->
        <div class="flex flex-col space-y-2 w-full">
            <label for="name" class="text-black dark:text-white font-semibold">Name</label>
            <input type="text" id="name"
                class="rounded-lg bg-gray-100 p-2 border-none dark:bg-gray-500 dark:text-white"
                wire:model.defer="state.name">
        </div>
        <!-- Parent ID -->
        <div class="flex flex-col space-y-2 w-full">
            <label for="parent_id" class="text-black dark:text-white font-semibold">Parent (If applicable)</label>
            <select id="parent_id" wire:model.defer="state.parent_id"
                class="rounded-xl dark:bg-gray-500 text-black dark:text-white">
                @if ($religions->isNotEmpty())
                    <option value="" selected="">Not Applicable</option>
                @endif
                @forelse ($religions as $religion)
                    <option value="{{ $religion->getKey() }}">{{ $religion->name }}</option>
                @empty
                    <option disabled>No religions</option>
                @endforelse
            </select>
        </div>
    </div>
    <div class="flex flex-col space-y-2 w-full">
        <label class="text-black dark:text-white font-semibold" for="description">Description</label>
        <textarea wire:model.defer="state.description" rows="10" id="description"
            class="rounded-lg bg-gray-100 p-2 border-none dark:bg-gray-500 text-black dark:text-white"></textarea>
    </div>
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
