<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use App\Models\Denomination;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;

class ReligionController extends Model
{
    public function list(Request $request)
    {
        $showPending = $request->get('showPending', false);

        return view('religions.list', [
            'showPending' => $showPending,
        ]);
    }

    public function create()
    {
        return view('religions.create');
    }

    public function createDenomination(Religion $religion)
    {
        $religion->load('denominations');

        return view('religions.create-denomination', [
            'religion' => $religion,
        ]);
    }

    public function editDenomination(Religion $religion, Denomination $denomination)
    {
        if ($denomination->religion_id !== $religion->getKey()) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('livewire.religions.update-denomination', [
            'religion' => $religion,
            'denomination' => $denomination,
        ]);
    }

    public function show(Religion $religion, Request $request)
    {
        $loadAmount = function ($query) use ($request) {
            $query->inRandomOrder()->take($request->get('limit', 10));
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

        return view('religions.show', [
            'religion' => $religion,
        ]);
    }

    public function addNugget(Religion $religion)
    {
        return view('religions.addNugget', [
            'religion' => $religion,
            'nuggetType' => \App\Models\Nugget::NUGGET_TYPES
        ]);
    }
}
