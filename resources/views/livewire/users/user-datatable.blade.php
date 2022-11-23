<div class="flex flex-col h-full w-full rounded-md p-4 space-y-4">
    <!-- "Table" -->
    <div class="w-full overflow-y-auto">
        <div class="flex flex-col space-y-4 w-full h-full">
            <!-- Header -->
            <div class="flex flex-shrink-0 px-4 text-gray-500">
                <div class="flex items-center flex-grow w-0 py-4 text-xs font-semibold text-center justify-center bg-gray-300 rounded-l-xl">
                    <span>User</span>
                </div>
                <div class="flex items-center flex-grow w-0 py-4 text-xs font-semibold text-center justify-center bg-gray-300">
                    <span>Current Faith</span>
                </div>
                <div class="flex items-center flex-grow w-0 py-4 text-xs font-semibold text-center justify-center bg-gray-300">
                    <span>Start of Faith</span>
                </div>
                <div class="flex items-center flex-grow w-0 py-4 text-xs font-semibold text-center justify-center bg-gray-300 rounded-r-xl">
                    <span>Actions</span>
                </div>
            </div>
            <!-- Body -->
            <div class="overflow-auto mx-4 bg-white rounded-xl overflow-y-auto p-2 space-y-6">
                @forelse ($users as $user)
                    <div class="flex flex-shrink-0">
                        <div class="flex items-center flex-grow w-0 py-2 text-sm text-gray-500 px-4">
                            <a class="flex flex-row space-x-4 items-center hover:bg-sky-200 p-4 rounded-xl" href="{{ $user['profile_url'] }}">
                                <img src="{{ $user['profile_photo_url'] }}" alt="{{ $user['username'] }}" class="w-12 h-12 rounded-full shadow-xl" />
                                <span class="text-md font-semibold">{{ $user['username'] }}</span>
                            </a>
                        </div>
                        <div class="flex items-center flex-grow w-0 py-2 text-sm text-gray-500 px-4 justify-center">
                            <span>{{ $user['faith']['title'] }}</span>
                        </div>
                        <div class="flex items-center flex-grow w-0 py-2 text-sm text-gray-500 px-4 justify-center">
                            <span>{{ $user['faith']['start_of_faith'] }}</span>
                        </div>
                        <div class="flex items-center flex-grow w-0 py-2 text-sm text-gray-500 px-4 justify-center">
                            <div class="flex flex-row space-x-4 items-center">
                                <button class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 transition text-white rounded-lg font-semibold">Edit</button>
                                <button class="px-4 py-2 bg-red-400 hover:bg-red-500 transition text-white rounded-lg font-semibold">Delete</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-shrink-0">
                        <div class="flex items-center flex-grow w-0 py-2 text-sm text-gray-500 px-4 text-center justify-center">
                            <span class="text-lg font-bold text-black">No Users</span>
                        </div>
                    </div>
                @endforelse
            </div>
            @if (false)
                <!-- Footer -->
                <div class="flex flex-shrink-0 rounded-xl px-4 mt-4">
                    <div class="flex items-center flex-grow w-0 px-4 text-gray-500">
                        <span class="font-semibold text-black">Total</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
