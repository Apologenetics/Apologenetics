<div @class([
    'flex flex-col-reverse xl:flex-row gap-8 xl:gap-2 justify-start xl:justify-between',
    $padding ?? 'py-4',
])>
    <!-- Title & Description -->
    <div class="w-full xl:w-3/5 flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
            <h3 class="text-2xl font-bold text-slate-700 dark:text-slate-300">{{ $item->title }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-300">{{ $item->description }}</p>
        </div>
        @if ($hasControls)
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 gap-x-4 gap-y-8 w-full max-w-full">
                <!-- Votes -->
                <livewire:item-votes :votable="$item" :type="$item::class" :modelId="$item->getKey()" />
                <!-- Comments -->
                <livewire:item-comments :commentable="$item" :type="$item::class" :modelId="$item->getKey()" />
                <!-- Supports -->
                <livewire:item-nuggetable :item="$item" :nuggetableTypeId="\App\Models\Nugget::NUGGET_TYPE_SUPPORT" />
                <!-- Refutes -->
                <livewire:item-nuggetable :item="$item" :nuggetableTypeId="\App\Models\Nugget::NUGGET_TYPE_REFUTE" />
                <!-- General -->
                <livewire:item-nuggetable :item="$item" :nuggetableTypeId="\App\Models\Nugget::NUGGET_TYPE_GENERAL" />

                @if (auth()->id() === $item->created_by)
                    <!-- Edit -->
                    <button class="flex flex-row space-x-2 text-sky-300 hover:text-sky-600 hover:cursor-pointer"
                        wire:click="edit">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15 22.75H9C3.57 22.75 1.25 20.43 1.25 15V9C1.25 3.57 3.57 1.25 9 1.25H11C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75H9C4.39 2.75 2.75 4.39 2.75 9V15C2.75 19.61 4.39 21.25 9 21.25H15C19.61 21.25 21.25 19.61 21.25 15V13C21.25 12.59 21.59 12.25 22 12.25C22.41 12.25 22.75 12.59 22.75 13V15C22.75 20.43 20.43 22.75 15 22.75Z"
                                fill="currentColor" />
                            <path
                                d="M8.49935 17.6901C7.88935 17.6901 7.32935 17.4701 6.91935 17.0701C6.42935 16.5801 6.21935 15.8701 6.32935 15.1201L6.75935 12.1101C6.83935 11.5301 7.21935 10.7801 7.62935 10.3701L15.5093 2.49006C17.4993 0.500059 19.5193 0.500059 21.5093 2.49006C22.5993 3.58006 23.0893 4.69006 22.9893 5.80006C22.8993 6.70006 22.4193 7.58006 21.5093 8.48006L13.6293 16.3601C13.2193 16.7701 12.4693 17.1501 11.8893 17.2301L8.87935 17.6601C8.74935 17.6901 8.61935 17.6901 8.49935 17.6901ZM16.5693 3.55006L8.68935 11.4301C8.49935 11.6201 8.27935 12.0601 8.23935 12.3201L7.80935 15.3301C7.76935 15.6201 7.82935 15.8601 7.97935 16.0101C8.12935 16.1601 8.36935 16.2201 8.65935 16.1801L11.6693 15.7501C11.9293 15.7101 12.3793 15.4901 12.5593 15.3001L20.4393 7.42006C21.0893 6.77006 21.4293 6.19006 21.4793 5.65006C21.5393 5.00006 21.1993 4.31006 20.4393 3.54006C18.8393 1.94006 17.7393 2.39006 16.5693 3.55006Z"
                                fill="currentColor" />
                            <path
                                d="M19.8496 9.82978C19.7796 9.82978 19.7096 9.81978 19.6496 9.79978C17.0196 9.05978 14.9296 6.96978 14.1896 4.33978C14.0796 3.93978 14.3096 3.52978 14.7096 3.40978C15.1096 3.29978 15.5196 3.52978 15.6296 3.92978C16.2296 6.05978 17.9196 7.74978 20.0496 8.34978C20.4496 8.45978 20.6796 8.87978 20.5696 9.27978C20.4796 9.61978 20.1796 9.82978 19.8496 9.82978Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                    <!-- Delete -->
                    <button class="flex flex-row space-x-2 text-red-300 hover:text-red-600 hover:cursor-pointer"
                        wire:click="delete">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.9997 6.72998C20.9797 6.72998 20.9497 6.72998 20.9197 6.72998C15.6297 6.19998 10.3497 5.99998 5.11967 6.52998L3.07967 6.72998C2.65967 6.76998 2.28967 6.46998 2.24967 6.04998C2.20967 5.62998 2.50967 5.26998 2.91967 5.22998L4.95967 5.02998C10.2797 4.48998 15.6697 4.69998 21.0697 5.22998C21.4797 5.26998 21.7797 5.63998 21.7397 6.04998C21.7097 6.43998 21.3797 6.72998 20.9997 6.72998Z"
                                fill="currentColor" />
                            <path
                                d="M8.50074 5.72C8.46074 5.72 8.42074 5.72 8.37074 5.71C7.97074 5.64 7.69074 5.25 7.76074 4.85L7.98074 3.54C8.14074 2.58 8.36074 1.25 10.6907 1.25H13.3107C15.6507 1.25 15.8707 2.63 16.0207 3.55L16.2407 4.85C16.3107 5.26 16.0307 5.65 15.6307 5.71C15.2207 5.78 14.8307 5.5 14.7707 5.1L14.5507 3.8C14.4107 2.93 14.3807 2.76 13.3207 2.76H10.7007C9.64074 2.76 9.62074 2.9 9.47074 3.79L9.24074 5.09C9.18074 5.46 8.86074 5.72 8.50074 5.72Z"
                                fill="currentColor" />
                            <path
                                d="M15.2104 22.7501H8.79039C5.30039 22.7501 5.16039 20.8201 5.05039 19.2601L4.40039 9.19007C4.37039 8.78007 4.69039 8.42008 5.10039 8.39008C5.52039 8.37008 5.87039 8.68008 5.90039 9.09008L6.55039 19.1601C6.66039 20.6801 6.70039 21.2501 8.79039 21.2501H15.2104C17.3104 21.2501 17.3504 20.6801 17.4504 19.1601L18.1004 9.09008C18.1304 8.68008 18.4904 8.37008 18.9004 8.39008C19.3104 8.42008 19.6304 8.77007 19.6004 9.19007L18.9504 19.2601C18.8404 20.8201 18.7004 22.7501 15.2104 22.7501Z"
                                fill="currentColor" />
                            <path
                                d="M13.6601 17.25H10.3301C9.92008 17.25 9.58008 16.91 9.58008 16.5C9.58008 16.09 9.92008 15.75 10.3301 15.75H13.6601C14.0701 15.75 14.4101 16.09 14.4101 16.5C14.4101 16.91 14.0701 17.25 13.6601 17.25Z"
                                fill="currentColor" />
                            <path
                                d="M14.5 13.25H9.5C9.09 13.25 8.75 12.91 8.75 12.5C8.75 12.09 9.09 11.75 9.5 11.75H14.5C14.91 11.75 15.25 12.09 15.25 12.5C15.25 12.91 14.91 13.25 14.5 13.25Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                @endif
            </div>
        @endif
    </div>
    <!-- Author Information -->
    <div class="w-full xl:w-2/5 flex flex-row space-x-6 items-center xl:justify-center">
        <!-- Avatar -->
        @if (isset($user->profile_photo_path))
            <img src="{{ $user->profile_photo_url }}" class="w-16 h-16 rounded-full shadow-xl"
                alt="{{ $user->username }}">
        @else
            <div class="w-16 h-16 rounded-full bg-gray-500"></div>
        @endif
        <!-- Post Author Information -->
        <div class="flex flex-col">
            <a href="{{ $user->profile_url }}" class="text-2xl font-bold text-sky-800 hover:underline">
                <span>{{ $user->username }}</span>
            </a>
            <p class="text-md text-slate-500">
                <span>{{ $user->faith->religion->name }}</span>
                @if (isset($user->faith->denomination))
                    <span>({{ $user->faith->denomination->name }})</span>
                @endif
            </p>
            @if (isset($itemType))
                <p class="text-sm font-semibold text-gray-700">
                    <span>Type: {{ $itemType }} - {{ $item->created_at->diffForHumans() }}</span>
                </p>
            @endif
        </div>
    </div>
</div>
