<div class="flex flex-col h-full w-full rounded-md p-4 space-y-4">
    <table class="w-full shadow-lg rounded-lg bg-white">
        <thead>
            <tr>
                <th class="py-4 bg-gray-200 text-center rounded-tl-lg">User</th>
                <th class="py-4 bg-gray-200 text-center">Current Faith</th>
                <th class="py-4 bg-gray-200 text-center">Start of Faith</th>
                <th class="py-4 bg-gray-200 text-center rounded-tr-lg">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($users as $user)
                <tr>
                    <td class="py-4">
                        <a class="flex flex-row space-x-4 items-center p-4 rounded-xl"
                            href="{{ $user['profile_url'] }}">
                            <img src="{{ $user['profile_photo_url'] }}" alt="{{ $user['username'] }}"
                                class="w-12 h-12 rounded-full shadow-xl" />
                            <span class="text-md font-semibold">{{ $user['username'] }}</span>
                        </a>
                    </td>
                    <td class="py-4 text-center">
                        <span>{{ $user['faith']['title'] }}</span>
                    </td>
                    <td class="py-4 text-center">
                        <span>{{ $user['faith']['start_of_faith'] }}</span>
                    </td>
                    <td class="py-4">
                        <div class="flex flex-row space-x-4 items-center justify-center">
                            <button
                                class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 transition text-white rounded-lg font-semibold">Edit</button>
                            <button
                                class="px-4 py-2 bg-red-400 hover:bg-red-500 transition text-white rounded-lg font-semibold">Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
