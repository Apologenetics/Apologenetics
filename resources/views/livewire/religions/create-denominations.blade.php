<div class="w-full h-auto p-8 rounded-2xl shadow-xl flex flex-col space-y-4">
    <p class="font-bold text-3xl text-black dark:text-white">Add denomination to: {{ $religion->name }}</p>
    <!-- Row 1 -->
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <label for="name" class="font-semibold text-md text-black dark:text-white">Name</label>
            <input type="text" id="name"
                class="w-full rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-white p-2 border-none"
                wire:model.defer="state.name" />
        </div>
    </div>
    <!-- Row 2 -->
    <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <label for="parent" class="font-semibold text-md text-black dark:text-white">Parent ID (If
                applicable)</label>
            <select id="parent" wire:model.defer="state.parent_id"
                class="rounded-xl dark:bg-gray-600 dark:text-white">
                <option value="" selected>Not Applicable</option>
                @foreach ($religion->denominations as $denomination)
                    <option value="{{ $denomination?->getAttribute('id') ?? $denomination['id'] }}">
                        {{ $denomination?->getAttribute('name') ?? $denomination['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
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
