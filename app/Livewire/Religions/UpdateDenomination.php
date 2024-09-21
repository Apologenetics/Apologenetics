<?php

namespace App\Livewire\Religions;

use App\Models\Religion;
use Illuminate\View\View;
use App\Models\Denomination;
use LivewireUI\Modal\ModalComponent;
use App\Traits\ConvertEmptyArrayStrings;
use Illuminate\Validation\ValidationException;
use App\Contracts\Denomination\UpdatesDenomination;
use App\Exceptions\Denomination\MismatchUpdateDenominationException;

class UpdateDenomination extends \Livewire\Component
{
    use ConvertEmptyArrayStrings;

    public ?Religion $religion;

    public ?Denomination $denomination;

    public array $state = [];

    /**
     * @throws MismatchUpdateDenominationException
     */
    public function mount(array $religionData = [], ?int $denominationId = null)
    {
        if (empty($religion) && empty($religionData)) {
            throw new MismatchUpdateDenominationException();
        }

        if (! empty($religionData)) {
            $this->religion = with(new Religion())->newInstance($religionData, true);

            $this->religion->load('allDenominations');
        }

        $this->denomination ??= isset($denominationId) && empty($this->denomination) ?
            $this->religion->allDenominations->find($denominationId) :
            $this->religion->allDenominations->first();

        $this->state = $this->denomination->toArray();
    }

    /**
     * @throws ValidationException
     */
    public function submit(UpdatesDenomination $updatesDenomination)
    {
        $updatesDenomination(
            $this->convertEmptyArrayStrings($this->state),
            $this->denomination
        );

        $this->closeModalWithEvents([
            'updated-denomination',
        ]);
    }

    public function render(): View
    {
        return view('livewire.religions.update-denomination');
    }
}
