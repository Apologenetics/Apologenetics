<?php

namespace App\Http\Controllers;

use App\Models\Doctrine;
use App\Models\Religion;
use Illuminate\View\View;
use App\Models\Denomination;
use Illuminate\Http\Request;

class DoctrineController extends Controller
{
    public function create(Request $request): View
    {
        $values = $request->validate([
            'denomination_id' => ['integer', 'nullable'],
            'religion_id' => ['integer', 'nullable'],
        ]);

        return view('doctrines.create', [
            'religion_id' => $values['religion_id'] ?? null,
            'denomination_id' => $values['denomination_id'] ?? null,
        ]);
    }

    public function list(): View
    {
        $religions = Religion::query()
            ->scopes(['active'])
            ->with(['doctrines.createdBy.faith', 'denominations.doctrines.createdBy.faith'])
            ->whereHas('doctrines')
            ->orWhereHas('denominations.doctrines')
            ->get();

        $empty = $religions->isEmpty();

        return view('doctrines.list', [
            'religions' => $religions,
            'empty' => $empty,
        ]);
    }

    public function religions(Religion $religion, Request $request): View
    {
        // TODO: Make datatable
        return view('doctrines.religionordenom', [
            'entity' => $religion,
        ]);
    }

    public function denominations(Denomination $denomination, Request $request): View
    {
        return view('doctrines.religionordenom', [
            'entity' => $denomination,
        ]);
    }

    public function show(Doctrine $doctrine): View
    {
        $doctrine->load([
            'nuggets' => [
                'createdBy',
                'createdBy.faith.religion',
                'createdBy.faith.denomination'
            ]
        ]);

        return view('doctrines.show', [
            'doctrine' => $doctrine,
        ]);
    }
}
