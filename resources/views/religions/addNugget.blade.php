<x-app-layout>
    <div class="p-8">
        <livewire:nuggets.create :model="$religion" :modelId="$religion->getKey()" :type="$religion::class" />
    </div>
</x-app-layout>
