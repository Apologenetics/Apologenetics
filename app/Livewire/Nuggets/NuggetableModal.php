<?php

namespace App\Livewire\Nuggets;

use App\Models\Nugget;
use App\Traits\MapsModels;
use LivewireUI\Modal\ModalComponent;
use App\Actions\Nuggets\CreateNugget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class NuggetableModal extends ModalComponent
{
    use MapsModels;

    public Model $item;

    public string $itemClass;

    public int $itemId;

    public string $itemType;

    public array $nuggetIds = [];

    public int $nuggetTypeId = 0;

    public array $filter = [];

    public array $state = [];

    public function mount()
    {
        if (! isset($this->item)) {
            $this->item = call_user_func([$this->itemClass, 'query'])
                ->with([
                    'createdBy:id,username,faith_id,profile_photo_path,first_name,last_name',
                    'createdBy.faith.religion:id,name',
                    'createdBy.faith.denomination:id,name,religion_id',
                ])
                ->find($this->itemId);
        }

        if (! $this->item->relationLoaded('nuggets')) {
            // TODO: Cache results? Lazy load? Results by key
            $this->item->setRelation(
                'nuggets',
                Nugget::query()
                    ->whereIn('id', $this->nuggetIds)
                    ->get()
            );
        }

        $this->itemClass ??= $this->item::class;

        $this->itemType = $this->mapToCodeName($this->itemClass);
    }

    /**
     * @throws ValidationException
     */
    public function post(CreateNugget $createNugget)
    {
        $createNugget(array_merge($this->state, [
            'nugget_type_id' => $this->nuggetTypeId,
        ]));
    }

    public function filter(int $type)
    {
        if (! isset(Nugget::NUGGET_TYPES[$type])) {
            $type = Nugget::NUGGET_TYPE_REFUTE;
        }

        $this->nuggetTypeId = $type;

        $this->item->setRelation(
            'nuggets',
            $this->getNuggetsOfType($this->nuggetTypeId)
        );
    }

    public function getNuggetsOfType(int $type)
    {
        return Nugget::query()
            ->select(['nuggets.*'])
            ->join('nuggetables', function ($join) use ($type) {
                $join->where('nuggetable_type', $this->itemClass);
                $join->where('nuggetable_id', $this->itemId);
            })
            ->where('nuggetables.nugget_type_id', $type)
            ->get();
    }

    public function render()
    {
        return view('livewire.nuggets.nuggetable-modal');
    }
}
