<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nugget;
use App\Models\Religion;
use Illuminate\View\View;

class NuggetController extends Controller
{
    public function list(): View
    {
        $nuggets = Nugget::with(['religions', 'denominations', 'doctrines', 'nuggetable'])->get();

        return view('nuggets.list', [
            'nuggets' => $nuggets,
        ]);
    }

    public function fromUser(User $user): View
    {
        $user->load(['nuggets']);

        return view('nuggets.user', [
            'user' => $user->withoutRelations(),
            'nuggets' => $user->nuggets ?? [],
        ]);
    }

    public function create(): View
    {
        $religions = Religion::query()
            ->select(['id', 'name'])
            ->where('approved', true)
            ->with(['denominations:id,name'])
            ->get();

        return view('nuggets.create', [
            'nuggetTypes' => Nugget::NUGGET_TYPES,
            'religions' => $religions
        ]);
    }
}
