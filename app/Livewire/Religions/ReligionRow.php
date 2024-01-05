<?php

namespace App\Livewire\Religions;

use Livewire\Component;
use App\Models\Religion;

class ReligionRow extends Component
{
    public Religion $religion;

    public function edit()
    {
        $this->dispatch('openModal', Edit::class, [
            'religionId' => $this->religion->getKey(),
        ]);
    }

    public function approve()
    {
        $this->religion->approved = true;
        $this->religion->save();

        $this->dispatch('updated-religion');
    }

    public function render()
    {
        return view('livewire.religions.religion-row');
    }
}
