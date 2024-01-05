<?php

namespace App\Services;

use App\Enums\Filterable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Collection2;

class SearchService
{
    public function getResultsOfType(string $search, string $type = 'all'): ?Collection2
    {
        $type = strtolower($type);
        $search = strtolower($search);

        if ($type !== 'all') {
            $typeClass = Filterable::fromString($type);

            if (is_null($typeClass)) {
                return null;
            }

            return call_user_func([$typeClass->value, 'query'])
                ->scopes(['search' => [$search]])
                ->get()
                ->collect();
        }

        return $this->getAllResults($search);
    }

    public function getAllResults(string $search): Collection2
    {
        return collect();
    }
}