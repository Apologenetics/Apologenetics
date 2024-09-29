<?php

namespace App\Livewire\Religions;

use Livewire\Component;
use App\Models\Doctrine;
use App\Models\Religion;
use Livewire\Attributes\On;
use Illuminate\Http\Request;

class ShowReligion extends Component
{
    public Religion $religion;

    public bool $showDoctrineModal = false;

    public bool $showNuggetModal = false;

    public bool $showDenominationModal = false;

    public int $loadAmount = 10;

    public function mount(Request $request, Religion $religion)
    {
        $this->loadAmount = $request->get('limit', 10);

        $loadAmount = function ($query) {
            $query->inRandomOrder()->take($this->loadAmount);
        };

        $religion->load([
            'allDenominations',
            'doctrines' => $loadAmount,
            'doctrines.createdBy',
            'doctrines.createdBy.faith.religion',
            'doctrines.createdBy.faith.denomination',
            'doctrines.nuggets' => $loadAmount,
            'allDenominations.nuggets',
            'nuggets' => $loadAmount,
            'posts',
        ]);

        $this->religion = $religion;
    }

    #[On('doctrine-created')]
    public function closeDoctrineModal($doctrine)
    {
        $this->updateDoctrinesList($doctrine);
        $this->showDoctrineModal = false;
    }

    public function updateDoctrinesList(array $doctrine)
    {
        if ($this->religion->doctrines->count() < $this->loadAmount) {
            $doctrine = new Doctrine($doctrine);
            $doctrine->load([
                'createdBy',
                'createdBy.faith.religion',
                'createdBy.faith.denomination'
            ]);

            $this->religion->doctrines->push($doctrine);
        }
    }

    #[On('nugget-created')]
    public function closeNuggetModal(array $nugget)
    {
        $this->updateNuggetList($nugget);
        $this->showNuggetModal = false;
    }

    public function updateNuggetList(array $nugget) {}

    #[On('denomination-created')]
    public function closeDenominationModal(array $denomination = [])
    {
        $this->showDenominationModal = false;
    }

    public function render()
    {
        return view('livewire.religions.show-religion');
    }
}
