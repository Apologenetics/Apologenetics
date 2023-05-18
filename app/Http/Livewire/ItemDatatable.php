<?php

namespace App\Http\Livewire;

use App\Traits\MapsModels;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

abstract class ItemDatatable extends Component
{
    use WithPagination, MapsModels;

    public string $entity;

    public Model $item;

    public string $itemType;

    public int $perPage = 5;

    public function mount()
    {
        $this->itemType ??= $this->mapToCodeName($this->item::class);
    }

    public abstract function getQuery(): Builder;

    public function render()
    {
        return view('livewire.item-datatable', [
            'items' => $this->getQuery()->simplePaginate(
                $this->perPage,
                page: $this->page
            )
        ]);
    }
}
