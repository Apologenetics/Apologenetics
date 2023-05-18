<x-app-layout>
    <div class="pb-2">
        <livewire:doctrines.doctrine-datatable
            :entity="$entity->title"
            :item="$entity"
            itemType="Doctrine"
        />
    </div>
</x-app-layout>
