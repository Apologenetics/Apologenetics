<?php

namespace App\Livewire\Religions;

use App\Models\Religion;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Database\Eloquent\Collection;

class ListReligions extends ModalComponent
{
    public ?Collection $religions = null;

    public bool $showPending = true;

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

    public function delete()
    {
    }

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

    public function newReligion()
    {
        // FIXME: Event not refreshing on modal
        $this->dispatch('openModal', Create::class);
        $this->dispatch('created-religion');
    }

    public function render()
    {
        return view('livewire.religions.list-religions');
    }
}
