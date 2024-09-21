<?php

namespace App\Livewire\Nuggets;

use App\Models\Nugget;
use App\Models\Nuggetable;
use App\Models\Religion;
use App\Traits\MapsModels;
use Illuminate\Database\Eloquent\Model;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    use MapsModels;

    public bool $includeTitle = true;

    public ?string $modelType = null;

    public ?int $modelId = null;

    public Model $model;

    public array $state = [];

    public function mount()
    {
        $this->modelType ??= $this->mapToCodeName(Religion::class);

        $this->modelId ??= 1;

        $this->model = call_user_func([$this->mapToClassName($this->modelType), 'query'])
            ->find($this->modelId);

        $this->state = ['type' => Nugget::NUGGET_TYPE_REFUTE];
    }

    public function submit()
    {
        // Create nugget and apply to
        // TODO: Validator
        $nugget = Nugget::query()
            ->create([
                'created_by' => \Illuminate\Support\Facades\Auth::id(),
                'title' => $this->state['title'],
                'explanation' => $this->state['content']
            ]);

        $nuggetable = Nuggetable::query()
            ->create([
                'nugget_id' => $nugget->getKey(),
                'nuggetable_id' => $this->modelId,
                'nuggetable_type' => $this->mapToClassName($this->modelType),
                'nugget_type_id' => $this->state['type'],
                'created_by' => \Illuminate\Support\Facades\Auth::id()
            ]);

        $this->state = ['message' => 'Nugget submitted'];
    }

    public function render()
    {
        return view('livewire.nuggets.create');
    }
}
