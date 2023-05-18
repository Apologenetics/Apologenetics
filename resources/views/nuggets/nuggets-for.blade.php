<x-app-layout>
    <div class="pb-2">
        <livewire:nuggets.nugget-datatable
            :entity="$entity->title"
            :item="$entity"
            itemType="Nuggets"
        />
    </div>
</x-app-layout>
