<?php

namespace App\Livewire\Religions;

use App\Models\Religion;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;

class ListReligions extends \Livewire\Component
{
    public ?Collection $religions = null;

    public bool $showPending = true;

    public bool $showCreateModal = false;

    protected $listeners = [
        'created-religion' => '$refresh',
        'updated-religion' => '$refresh',
    ];

    public function mount(array $religionIds = [])
    {
        if (is_null($this->religions)) {
            $religions = Religion::query()->with('follows');

            if (empty($religionIds)) {
                $this->religions = $this->showPending ?
                    $religions->get() :
                    $religions->where('approved', true)->get();
            } else {
                $this->religions = $religions->whereIn('id', $religionIds)->get();
            }
        }
    }

    public function approve($id)
    {
        if (is_numeric($id)) {
            // TODO: Change from this edit to the edit modal
            Religion::query()
                ->where('id', $id)
                ->update(['approved' => true]);

            $this->dispatch('updated-religion');
        }
    }

    public function edit($id)
    {
        $this->dispatch('openModal', Edit::class, [
            'religionId' => $id,
        ]);
    }

    public function delete() {}

    public function pending()
    {
        // Maybe there is a better way for this?
        // Might need to fix for pagination
        // Only show if user is admin
        $this->showPending = ! $this->showPending;

        $this->religions = $this->showPending ?
            Religion::query()->get() :
            Religion::query()->where('approved', true)->get();
    }

    #[On('religion-created')]
    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }

    public function render()
    {
        return view('livewire.religions.list-religions');
    }
}
