<div class="flex flex-row justify-between items-center">
    <a class="font-semibold text-md text-black dark:text-white"
        href="{{ route('religions.show', ['religion' => $religion->getKey()]) }}">
        <span>{{ $religion->name }}</span>
        @if (!$religion->approved)
            <span> - (pending)</span>
        @endif
        @if ($religion->follows->isNotEmpty())
            <span> - {{ $religion->follows->count() }} Followers</span>
        @endif
    </a>
    <div class="flex flex-row space-x-2">
        @if (!$religion->approved)
            <button type="button"
                class="hover:cursor-pointer text-white font-semibold py-1 px-6 text-lg rounded-md bg-green-300 hover:bg-green-400"
                wire:click="approve">Approve</button>
        @endif
        <button type="button"
            class="hover:cursor-pointer text-white font-semibold py-1 px-6 text-lg rounded-md bg-yellow-300 hover:bg-yellow-400"
            wire:click="edit">Edit</button>
        <button type="button"
            class="hover:cursor-pointer text-white font-semibold py-1 px-6 text-lg rounded-md bg-red-300 hover:bg-red-400"
            wire:click="delete">Delete</button>
    </div>
</div>
