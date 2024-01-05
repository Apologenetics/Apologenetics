<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class SearchController extends Controller
{
    public function __construct(
        public SearchService $searchService = new SearchService()
    ) {}

    public function __invoke(Request $request)
    {
        $request->validate([
            'q' => ['string'],
            'type' => ['nullable', 'string']
        ]);

        $validated = $request->only(['q', 'type']);

        if (array_key_exists('type', $validated)) {
            $results = $this->searchService->getResultsOfType(
                $validated['q'], $validated['type']
            );
        }

        return view('search.results', [
            'results' => $results ?? null,
            'query' => urldecode($validated['q']),
            'type' => isset($validated['type'])
                ? urldecode($validated['type'])
                : null,
        ]);
    }
}
