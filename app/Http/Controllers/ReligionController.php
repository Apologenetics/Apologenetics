<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use App\Models\Denomination;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class ReligionController extends Model
{
    public function list(Request $request): View
    {
        $showPending = $request->get('showPending', false);

        return view('religions.list', [
            'showPending' => $showPending,
        ]);
    }

    public function create(): View
    {
        return view('religions.create');
    }

    public function createDenomination(Religion $religion): View
    {
        $religion->load('denominations');

        return view('religions.create-denomination', [
            'religion' => $religion,
        ]);
    }

    public function editDenomination(Religion $religion, Denomination $denomination): View
    {
        if ($denomination->religion_id !== $religion->getKey()) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('livewire.religions.update-denomination', [
            'religion' => $religion,
            'denomination' => $denomination,
        ]);
    }

    public function show(Religion $religion, Request $request) {}

    public function addNugget(Religion $religion): View
    {
        return view('religions.addNugget', [
            'religion' => $religion,
            'nuggetType' => \App\Models\Nugget::NUGGET_TYPES
        ]);
    }
}
