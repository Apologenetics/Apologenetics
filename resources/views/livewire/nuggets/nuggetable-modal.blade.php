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
        @foreach(\App\Models\Nugget::NUGGET_TYPES as $key => $nuggetType)
            <button wire:click="filter({{ $key }})" @class([
                'text-sky-300 rounded-lg py-2 px-4',
                'hover:bg-sky-50' => true,
                'bg-white text-sky-400 hover:bg-sky-200 font-bold' => $key === $nuggetTypeId
            ])>
                {{ ucwords($nuggetType) }}
            </button>
        @endforeach
    </div>
    <!-- Responses -->
    @if ($item->nuggets->isEmpty())
        {{-- TODO: Image instead of text --}}
        <h2 class="text-2xl font-bold text-slate-700 text-center">No responses</h2>
    @else
        <div class="flex flex-col space-y-8 divide-y divide-sky-200">
            @foreach ($item->nuggets->where('pivot.nugget_type_id', $nuggetTypeId) as $nugget)
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
    <div class="w-full flex flex-col space-y-8">
        <div class="w-full flex flex-col space-y-2">
            <label for="nugget_title" class="text-md font-semibold">Title</label>
            <input type="text" wire:model="state.title" id="nugget_title"
                   class="w-full rounded-md ring-1 border-none ring-0 bg-gray-100 placeholder-gray-400" placeholder="Enter title..." />
        </div>
        <div class="w-full flex flex-col space-y-2">
            <label for="nugget_content" class="text-md font-semibold">Description</label>
            <textarea type="text" wire:model="state.explanation" id="nugget_content"
                   class="w-full rounded-md ring-1 border-none ring-0 bg-gray-100 placeholder-gray-400" placeholder="Enter description..." ></textarea>
        </div>
        <div class="w-full justify-end items-center flex flex-row space-x-4">
            <button wire:click="post" class="px-4 py-2 rounded-md text-white bg-sky-800 font-semibold">Submit</button>
        </div>
    </div>
</div>
