<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class SeparatedFeed extends Component
{
    use WithPagination;

    public string $query;

    public function render()
    {
        return view('livewire.separated-feed');
    }
}
