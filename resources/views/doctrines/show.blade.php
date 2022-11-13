<x-app-layout>
    <div class="w-full flex flex-col space-y-4 px-6 py-8">
        <!-- Doctrine -->
        <div class="w-full h-fit p-8 bg-white rounded-2xl shadow-2xl flex flex-col space-y-2">
            <h2 class="text-2xl font-bold text-sky-900">{{ $doctrine->title }}</h2>
            @if (isset($doctrine->description))
                <p class="text-gray-700 text-sm">{{ $doctrine->description }}</p>
            @endif
        </div>
        <!-- Nuggets -->
        <div class="w-full h-fit bg-white rounded-2xl shadow-2xl flex flex-col space-y-4">
            <livewire:nuggets.nuggetable-modal :item="$doctrine" />
        </div>
    </div>
</x-app-layout>
