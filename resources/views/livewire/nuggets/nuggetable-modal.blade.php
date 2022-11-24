@php use App\Models\Nugget @endphp

<div class="flex flex-col p-8 space-y-8">
    <!-- Header -->
    <div class="w-full flex flex-row space-x-6 items-center">
        <!-- Avatar -->
        @if (! empty($item->createdBy->profile_photo_path))
            <img src="{{ $item->createdBy->profile_photo_url }}"
                 class="w-16 h-16 rounded-full shadow-xl"
                 alt="{{ $item->createdBy->username }}">
        @else
            <div class="w-16 h-16 rounded-full bg-gray-500"></div>
        @endif
        <!-- Post Author Information -->
        <div class="flex flex-col">
            <a href="{{ $item->createdBy->profile_url }}"
               class="text-lg font-semibold text-sky-800 hover:underline hover:text-sky-600">
                <span>{{ $item->createdBy->username }}</span>
            </a>
            <p class="text-md text-slate-500">
                <span>{{ $item->createdBy->faith_title }}</span>
            </p>
            <p class="text-sm font-semibold text-gray-700">
                <span>Type: {{ $itemType }} - {{ $item->created_at->diffForHumans() }}</span>
            </p>
        </div>
    </div>
    <!-- Title & Description -->
    <div class="flex flex-col space-y-2 w-full pb-4">
        <h2 class="text-2xl text-slate-700 font-bold">{{ $item->title }}</h2>
        @if (isset($item->description))
            <p class="text-sm text-gray-500">{{ $item->description }}</p>
        @endif
    </div>
    <!-- Feed filters -->
    <div class="flex flex-row space-x-2 p-2 bg-sky-100 rounded-xl w-fit">
        <button wire:click="filter('browse_all')" @class([
            'text-sky-300 rounded-lg px-4',
            'hover:bg-sky-50' => false,
            'bg-white text-sky-400 hover:bg-sky-200 font-bold' => true
        ])>
            Refutes
        </button>
        <button wire:click="filter('recent')" @class([
            'text-sky-300 rounded-lg py-2 px-4',
            'hover:bg-sky-50' => true,
            'bg-white text-sky-400 hover:bg-sky-200 font-bold' => false
        ])>
            Supports
        </button>
        <button wire:click="filter('following')" @class([
            'text-sky-300 rounded-lg py-2 px-4',
            'hover:bg-sky-50' => true,
            'bg-white text-sky-400 hover:bg-sky-200 font-bold' => false
        ])>
            Generals
        </button>
        <button wire:click="filter('following')" @class([
            'text-sky-300 rounded-lg py-2 px-4',
            'hover:bg-sky-50' => true,
            'bg-white text-sky-400 hover:bg-sky-200 font-bold' => false
        ])>
            Contradictions
        </button>
    </div>
    <!-- Responses -->
    @if ($item->nuggets->isEmpty())
        {{-- TODO: Image instead of text --}}
        <h2 class="text-2xl font-bold text-slate-700 text-center">No responses</h2>
    @else
        <div class="flex flex-col space-y-8 divide-y divide-sky-200">
            @foreach ($item->nuggets->where('pivot.nugget_type_id', 0) as $nugget)
                <div class="flex flex-row space-y-6 justify-between w-full items-center">
                    <!-- Avatar & Information -->
                    <div class="w-1/2 flex flex-row space-x-6 items-center">
                        <!-- Avatar -->
                        @if (isset($nugget->createdBy->profile_photo_path))
                            <img src="{{ $nugget->createdBy->profile_photo_url }}"
                                 class="w-16 h-16 rounded-full shadow-xl"
                                 alt="{{ $nugget->createdBy->username }}">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-500"></div>
                        @endif
                        <!-- Post Author Information -->
                        <div class="flex flex-col">
                            <a href="{{ $nugget->createdBy->profile_url }}"
                               class="text-2xl font-bold text-sky-800 hover:underline">
                                <span>{{ $nugget->createdBy->username }}</span>
                            </a>
                            <p class="text-md text-slate-500">
                                <span>{{ $nugget->createdBy->faith->religion->name }}</span>
                                @if (isset($nugget->createdBy->faith->denomination))
                                    <span>({{ $nugget->createdBy->faith->denomination->name }})</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- Title and Description -->
                    <div class="flex flex-col space-y-2 w-1/2">
                        <h2 class="text-2xl font-bold text-slate-900 text-center">{{ $nugget->title }}</h2>
                        @if (isset($nugget->description))
                            <p class="text-sm text-gray-700 text-center">{{ $nugget->description }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <!-- Comment -->
    <div class="relative items-center">
        <textarea type="search" id="search" class="block py-4 px-6 w-full text-sm text-gray-900 bg-white rounded-lg shadow-xl border-sky-200" placeholder="Add comment..."></textarea>
        <button type="submit" class="absolute right-3.5 bottom-3.5">
            <svg class="text-sky-400 hover:text-sky-500" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.40995 21.7499C4.28995 21.7499 3.57995 21.3699 3.12995 20.9199C2.24995 20.0399 1.62995 18.1699 3.60995 14.1999L4.47995 12.4699C4.58995 12.2399 4.58995 11.7599 4.47995 11.5299L3.60995 9.7999C1.61995 5.8299 2.24995 3.9499 3.12995 3.0799C3.99995 2.1999 5.87995 1.5699 9.83995 3.5599L18.3999 7.8399C20.5299 8.8999 21.6999 10.3799 21.6999 11.9999C21.6999 13.6199 20.5299 15.0999 18.4099 16.1599L9.84995 20.4399C7.90995 21.4099 6.46995 21.7499 5.40995 21.7499ZM5.40995 3.7499C4.86995 3.7499 4.44995 3.8799 4.18995 4.1399C3.45995 4.8599 3.74995 6.7299 4.94995 9.1199L5.81995 10.8599C6.13995 11.5099 6.13995 12.4899 5.81995 13.1399L4.94995 14.8699C3.74995 17.2699 3.45995 19.1299 4.18995 19.8499C4.90995 20.5799 6.77995 20.2899 9.17995 19.0899L17.7399 14.8099C19.3099 14.0299 20.1999 12.9999 20.1999 11.9899C20.1999 10.9799 19.2999 9.9499 17.7299 9.1699L9.16995 4.8999C7.64995 4.1399 6.33995 3.7499 5.40995 3.7499Z" fill="currentColor"/>
                <path d="M10.8395 12.75H5.43945C5.02945 12.75 4.68945 12.41 4.68945 12C4.68945 11.59 5.02945 11.25 5.43945 11.25H10.8395C11.2495 11.25 11.5895 11.59 11.5895 12C11.5895 12.41 11.2495 12.75 10.8395 12.75Z" fill="currentColor"/>
            </svg>
        </button>
    </div>
</div>
