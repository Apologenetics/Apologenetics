<?php

namespace App\Livewire\Doctrines;

use Livewire\Component;
use App\Models\Religion;
use App\Models\Denomination;
use App\Exceptions\Doctrine\InvalidDoctrineSourceException;
use App\Traits\MapsModels;
use Illuminate\Support\Pluralizer;
use Livewire\Attributes\On;

class ShowDoctrines extends Component
{
    use MapsModels;

    public Religion|Denomination $entity;

    public bool $childrenHaveDoctrine = false;

    public bool $isReligion;

    public bool $showChildren = true;

    public bool $showTitle = true;

    public int $limit = 4;

    public string $type;

    protected const ALLOWED_CLASSES = [
        'App\Models\Religion',
        'App\Models\Denomination',
    ];

    /**
     * @throws InvalidDoctrineSourceException
     */
    public function mount(?string $className = null, ?int $id = null, bool $showChildren = true)
    {
        // TODO: Do not repeat a doctrine if it is already in the children? Or parent?

        if (isset($className)) {
            if (! in_array($className, self::ALLOWED_CLASSES) || is_null($id)) {
                throw new InvalidDoctrineSourceException($className);
            }

            $this->entity = call_user_func([$className, 'query'])
                ->withCount(['doctrines' => fn($q) => $q->take($this->limit)])
                ->find($id);
        }

        if (! $this->entity->relationLoaded('doctrines')) {
            $this->entity->load('doctrines.nuggets');
        }

        $this->type = strtolower(Pluralizer::plural($this->mapToCodeName($this->entity::class)));

        $this->checkChildren();
    }

    protected function checkChildren()
    {
        if ($this->isReligion = $this->entity instanceof Religion) {
            $this->childrenHaveDoctrine = $this->entity->denominations
                ->filter(fn($v) => $v->doctrines->isNotEmpty())
                ->isNotEmpty();
        }
    }

    public function update()
    {
        $this->entity->refresh();

        $this->entity->load('allDenominations.doctrines');

        $this->checkChildren();
    }

    public function render()
    {
        return view('livewire.doctrines.show-doctrines');
    }
}
