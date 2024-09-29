<div class="flex flex-col space-y-4 w-full p-8 bg-white dark:bg-gray-700 rounded-xl" x-data="{ showModal: @entangle('showCreateModal') }">
    <div class="flex flex-col md:flex-row h-fit gap-4 w-full flex-grow">
        <p class="text-3xl font-semibold text-black dark:text-white">
            Religions - ({{ $religions->where('approved', true)->count() }})
        </p>
        <div class="flex flex-row gap-4 flex-wrap">
            <x-button wire:click="pending">
                <svg wire:loading wire:target="pending" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                {{ $showPending ? 'Hide Pending' : 'Show Pending' }}
            </x-button>
            <x-button @click="showModal = !showModal">
                + New Religion
            </x-button>
        </div>
    </div>
    <div class="flex flex-col space-y-2">
        @forelse ($religions as $religion)
            <livewire:religions.religion-row :religion="$religion" :wire:key="$religion->getKey()" />
        @empty
            <div class="flex justify-center items-center w-full">
                <p class="font-semibold text-md">No religions</p>
            </div>
        @endforelse
    </div>
    @push('modal')
        <x-modal id="create-religion" wire:model="showCreateModal">
            <livewire:religions.create :religions="$religions" />
        </x-modal>
    @endpush
</div>
