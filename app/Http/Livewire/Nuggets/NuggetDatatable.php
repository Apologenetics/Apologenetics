<?php

namespace App\Http\Livewire\Nuggets;

use App\Models\Nugget;
use App\Http\Livewire\ItemDatatable;
use Illuminate\Database\Eloquent\Builder;

class NuggetDatatable extends ItemDatatable
{
    public function getQuery(): Builder
    {
        return Nugget::query()
            ->join('nuggetables', 'nuggetables.nugget_id', 'nuggets.id')
            ->where('nuggetable_type', $this->item::class)
            ->where('nuggetable_id', $this->item->getKey());
    }
}
