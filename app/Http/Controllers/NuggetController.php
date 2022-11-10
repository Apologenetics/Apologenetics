<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nugget;
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
}
