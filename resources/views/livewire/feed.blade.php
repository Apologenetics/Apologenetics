<div class="flex flex-col space-y-4" x-cloak>
    <!-- Feed filters -->
    <div class="flex flex-row space-x-2 p-2 bg-sky-100 dark:bg-sky-800 rounded-xl w-full mt-2 md:mt-0 md:w-fit">
        <button wire:click="filter('browse_all')" @class([
            'text-sky-300 rounded-lg px-4 dark:hover:bg-sky-700 transition',
            'hover:bg-sky-50' => !$filter['browse_all'],
            'bg-white text-sky-400 hover:bg-sky-200 font-bold dark:bg-sky-950' =>
                $filter['browse_all'],
        ])>
            Browse All
        </button>
        <button wire:click="filter('recent')" @class([
            'text-sky-300 rounded-lg py-2 px-4 dark:hover:bg-sky-700 transition',
            'hover:bg-sky-50' => !$filter['recent'],
            'bg-white text-sky-400 hover:bg-sky-200 font-bold dark:bg-sky-950' =>
                $filter['recent'],
        ])>
            Recent
        </button>
        <button wire:click="filter('following')" @class([
            'text-sky-300 rounded-lg py-2 px-4 dark:hover:bg-sky-700 transition',
            'hover:bg-sky-50' => !$filter['following'],
            'bg-white text-sky-400 hover:bg-sky-200 font-bold dark:bg-sky-950' =>
                $filter['following'],
        ])>
            Following
        </button>
    </div>
    <div class="flex flex-col space-y-12 pb-6">
        <!-- Feed Items -->
        @forelse ($feedItems as $item)
            <div class="w-full h-auto bg-white dark:bg-gray-700 rounded-2xl flex flex-col p-6 space-y-4 shadow-xl">
                <!-- Header -->
                <div class="w-full md:w-2/5 flex flex-row space-x-6 items-center">
                    <!-- Avatar -->
                    @if (!empty($item['created_by_avatar']))
                        <img src="{{ $item['created_by_avatar'] }}" class="w-16 h-16 rounded-full shadow-xl"
                            alt="{{ $item['created_by'] }}">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gray-500"></div>
                    @endif
                    <!-- Post Author Information -->
                    <div class="flex flex-col">
                        <a href="{{ $item['profile_url'] }}"
                            class="text-lg font-semibold text-sky-800 hover:underline hover:text-sky-600 dark:text-sky-400 dark:hover:text-sky-300">
                            <span>{{ $item['created_by'] }}</span>
                        </a>
                        <p class="text-md text-slate-500 dark:text-slate-200">
                            <span>{{ $item['faith_title'] }}</span>
                        </p>
                        <p class="text-sm font-semibold text-gray-700 dark:text-slate-300">
                            <span>Type: {{ $item['type'] }} - {{ $item['created_at'] }}</span>
                        </p>
                    </div>
                </div>
                <!-- Body -->
                <div class="flex flex-col space-y-4">
                    @if (isset($item['title']))
                        <p class="text-sky-900 font-bold text-2xl dark:text-sky-400">
                            {{ $item['title'] }}</p>
                    @endif

                    @if (isset($item['content']))
                        <p class="text-slate-500 dark:text-slate-300">{{ $item['content'] }}</p>
                    @endif
                </div>
                <!-- Footer -->
                <div class="flex flex-row space-x-4 items-center">
                    <!-- Votes -->
                    <livewire:item-votes :votable="$item" />
                    <!-- Comments -->
                    <livewire:item-comments :commentable="$item" />
                </div>
            </div>
        @empty
            <div class="w-full h-96 border border-gray-300 rounded-xl flex justify-center items-center">
                <p class="font-bold text-xl text-sky-500">No Feed Items Available.</p>
            </div>
        @endforelse
    </div>
</div>
