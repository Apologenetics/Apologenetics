<div class="w-full h-full p-8 flex flex-col space-y-8 items-start">
    <h2 class="text-3xl font-bold text-sky-900">{{ $entity }} {{ $itemType }}</h2>
    <div class="w-full h-fit flex flex-col space-y-4 bg-white rounded-2xl p-8 divide-y divide-sky-300">
        @forelse($items as $item)
            <livewire:item wire:key="{{ $item->getKey() }}" :item="$item->withoutRelations()"
                :user="$item->createdBy" />
        @empty
            <div class="w-full flex justify-center items-center">
                <h3 class="text-2xl text-bold">No {{ $itemType }}...</h3>
            </div>
        @endforelse
    </div>
    <!-- Pagination -->
    <div class="w-full flex flex-row space-x-4 justify-between">
        <button class="text-gray-600 disabled:text-gray-300 transition hover:text-gray-900"
            @disabled($items->onFirstPage()) wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
            <div class="flex flex-row space-x-4 items-center">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.9993 20.67C14.8093 20.67 14.6193 20.6 14.4693 20.45L7.9493 13.93C6.8893 12.87 6.8893 11.13 7.9493 10.07L14.4693 3.55002C14.7593 3.26002 15.2393 3.26002 15.5293 3.55002C15.8193 3.84002 15.8193 4.32002 15.5293 4.61002L9.0093 11.13C8.5293 11.61 8.5293 12.39 9.0093 12.87L15.5293 19.39C15.8193 19.68 15.8193 20.16 15.5293 20.45C15.3793 20.59 15.1893 20.67 14.9993 20.67Z" fill="currentColor"/>
                </svg>
                <span>Previous</span>
            </div>
        </button>
        <button class="text-gray-600 disabled:text-gray-300 transition hover:text-gray-900"
            @disabled(! $items->hasMorePages()) wire:click="nextPage" wire:loading.attr="disabled" rel="next">
            <div class="flex flex-row space-x-4 items-center">
                <span>Next</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.90961 20.67C8.71961 20.67 8.52961 20.6 8.37961 20.45C8.08961 20.16 8.08961 19.68 8.37961 19.39L14.8996 12.87C15.3796 12.39 15.3796 11.61 14.8996 11.13L8.37961 4.61002C8.08961 4.32002 8.08961 3.84002 8.37961 3.55002C8.66961 3.26002 9.14961 3.26002 9.43961 3.55002L15.9596 10.07C16.4696 10.58 16.7596 11.27 16.7596 12C16.7596 12.73 16.4796 13.42 15.9596 13.93L9.43961 20.45C9.28961 20.59 9.09961 20.67 8.90961 20.67Z" fill="currentColor"/>
                </svg>
            </div>
        </button>
    </div>
</div>
