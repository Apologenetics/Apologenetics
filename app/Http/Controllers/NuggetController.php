<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nugget;
use App\Models\Religion;
use Illuminate\View\View;
use App\Models\Denomination;
use App\Models\Doctrine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function religion(Religion $religion)
    {
        return view('nuggets.nuggets-for', [
            'entity' => $religion,
        ]);
    }

    public function denomination(Denomination $denomination)
    {
        return view('nuggets.nuggets-for', [
            'entity' => $denomination
        ]);
    }

    public function doctrine(Doctrine $doctrine)
    {
        return view('nuggets.nuggets-for', [
            'entity' => $doctrine
        ]);
    }
}
