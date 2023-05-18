<?php

namespace App\Http\Livewire\Doctrines;

use App\Models\Doctrine;
use App\Http\Livewire\ItemDatatable;
use Illuminate\Database\Eloquent\Builder;

class DoctrineDatatable extends ItemDatatable
{
    public function getQuery(): Builder
    {
        return Doctrine::query()
            ->join('doctrinables', 'doctrinables.doctrine_id', 'doctrines.id')
            ->where('doctrinable_type', $this->item::class)
            ->where('doctrinable_id', $this->item->getKey());
    }
}
