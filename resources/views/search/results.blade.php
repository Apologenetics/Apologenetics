<x-app-layout>
    <div class="flex flex-col space-y-6 w-full pt-4 px-6">
        <!-- Search query -->
        <h2 class="text-3xl font-bold text-sky-900 text-center">Search Results for "{{ $query }}"</h2>
        <!-- Filters -->
        <div class="flex flex-row space-x-4 w-full items-center">
            <p class="text-lg text-slate-600 font-semibold">Filters:</p>
            <!-- TODO: Make work like checkboxes -->
            <button class="bg-sky-500 text-white px-4 py-2 font-semibold text-sm rounded-md shadow-md">All</button>
            @foreach (['Nuggets', 'Doctrine', 'Users', 'Churches', 'Religions', 'Denominations'] as $filter)
                <button class="bg-sky-200 text-sky-400 px-4 py-2 font-semibold text-sm rounded-md shadow-md">{{ $filter }}</button>
            @endforeach
            <!-- Advanced filters Button -->
            <button class="flex flex-row items-center space-x-2">
                <svg class="w-4 h-4 text-sky-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sky-400 text-md">Advanced Filters</p>
            </button>
        </div>
    </div>
</x-app-layout>
