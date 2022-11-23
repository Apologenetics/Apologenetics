<x-app-layout>
    <div class="flex flex-col w-full h-full justify-center items-center">
        @if ($users->isEmpty())
            <p class="text-center font-semibold">No users available</p>
        @else
            <livewire:users.user-datatable />
        @endif
    </div>
</x-app-layout>
