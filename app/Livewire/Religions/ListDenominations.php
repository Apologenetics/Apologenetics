<?php

namespace App\Livewire\Religions;

use App\Models\Religion;
use App\Models\Denomination;
use LivewireUI\Modal\ModalComponent;

class ListDenominations extends ModalComponent
{
    public Religion $religion;

    protected $listeners = [
        'updated-denomination' => '$refresh',
        'created-denomination' => '$refresh',
    ];

    public function mount()
    {
        if (! $this->religion->relationLoaded('allDenominations')) {
            $this->religion->load('allDenominations');
        }
    }

    public function approve($id)
    {
        Denomination::query()
            ->where('id', $id)
            ->update(['approved' => true]);

        $this->dispatch('updated-denomination');
    }

    public function edit($id)
    {
        $this->dispatch('openModal', UpdateDenomination::class, [
            'religionData' => $this->religion->withoutRelations()->toArray(),
            'denominationId' => $id,
        ]);
    }

    public function newDenomination()
    {
        $this->dispatch('openModal', CreateDenominations::class, [
            'religionData' => $this->religion->withoutRelations()->toArray(),
        ]);
    }

    public function render()
    {
        return view('livewire.religions.list-denominations');
    }
}
