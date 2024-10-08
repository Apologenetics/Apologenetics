<?php

namespace App\Livewire\Faith;

use App\Models\User;
use App\Models\Faith;
use App\Models\Religion;
use App\Models\Denomination;
use App\Actions\Faith\UpdateFaith;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Database\Eloquent\Collection;

class EditFaith extends \Livewire\Component
{
    public Collection $religions;

    public ?Collection $denominations = null;

    public Faith $faith;

    public array $state = [];

    public User $user;

    protected $listeners = [
        'updated-faith' => 'updatedFaith',
    ];

    public function mount(Faith $faith, User $user)
    {
        $this->religions = Religion::query()
            ->where('approved', true)
            ->get();

        $this->faith = $faith;

        $this->state = $faith->toArray();

        $this->user = $user;

        $this->denominations = Denomination::query()
            ->where('religion_id', $this->state['religion_id'])
            ->where('approved', true)
            ->get();
    }

    public function updatedStateReligionId()
    {
        $this->denominations = Denomination::query()
            ->where('religion_id', $this->state['religion_id'])
            ->get();
    }

    public function newFaith()
    {
        $this->dispatch('openModal', NewFaith::class, [
            'user_id' => $this->user->getKey(),
        ]);
    }

    public function updateFaith(\App\Livewire\Faith\UpdateFaith $updateFaith)
    {
        $updateFaith(
            $this->state,
            $this->denominations->isNotEmpty(),
            $this->faith
        );

        $this->dispatch('updated-faith');
    }

    public function updatedFaith()
    {
        $this->state = Faith::query()
            ->where('user_id', $this->state['user_id'])
            ->latest('id')
            ->first()
            ->toArray();

        $this->denominations = Denomination::query()
            ->where('approved', true)
            ->where('religion_id', $this->state['religion_id'])
            ->get();
    }

    public function showLoad()
    {
        $this->showLoad = ! $this->showLoad;
    }

    public function render()
    {
        return view('livewire.faith.edit-faith');
    }
}
