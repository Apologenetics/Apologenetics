<div class="flex flex-col space-y-4">
    <div class="flex flex-row space-x-4 justify-between items-center">
        @if (isset($title))
            <h2 class="font-bold text-2xl text-sky-900">{{ $title }}</h2>
        @endif
        @if (isset($modalName))
            <button wire:click="$dispatch('openModal', { component: '{{ $modalName }}', arguments: {{ json_encode($modalParams) }} })">
                {!! $button ?? '<svg class="text-gray-400 hover:text-gray-700 transition" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z" fill="currentColor"/>
                            <path d="M16 12.75H8C7.59 12.75 7.25 12.41 7.25 12C7.25 11.59 7.59 11.25 8 11.25H16C16.41 11.25 16.75 11.59 16.75 12C16.75 12.41 16.41 12.75 16 12.75Z" fill="currentColor"/>
                            <path d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16V8C11.25 7.59 11.59 7.25 12 7.25C12.41 7.25 12.75 7.59 12.75 8V16C12.75 16.41 12.41 16.75 12 16.75Z" fill="currentColor"/>
                        </svg>' !!}
            </button>
        @endif
    </div>
    @forelse ($items as $item)
        <div class="flex flex-row space-x-4 justify-between items-center">
            <a class="font-semibold text-xl text-black"
                href="{{ $item->getAttribute('url') }}">
                <span>{{ $item->getAttribute('title') }}</span>
            </a>
            @if ($item instanceof \App\Contracts\Approvable && (! $item->approved ?? false) && ! in_array($loop->index, $itemState['updated']))
                <div class="flex flex-row space-x-2">
                    <button class="px-4 py-2 text-white text-sm font-semibold bg-green-400 hover:bg-green-500 transition-all rounded-lg"
                            wire:click="approve({{ $loop->index }})">
                        <span>Approve</span>
                    </button>
                    <button class="px-4 py-2 text-white text-sm font-semibold bg-red-400 hover:bg-red-500 transition-all rounded-lg"
                            wire:click="delete({{ $loop->index }})">
                        <span>Delete</span>
                    </button>
                </div>
            @endif
        </div>
    @empty
        <div class="flex items-center justify-center">
            <span>No items available</span>
        </div>
    @endforelse

    @if ($items->count() > 10)
        <a href="#" class="text-lg font-semibold hover:underline text-sky-700 hover:text-sky-800">
            <span>See More</span>
        </a>
    @endif
</div>
