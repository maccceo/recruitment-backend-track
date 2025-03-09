<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;

abstract class BaseController
{
    protected function applyFilters(Builder $query, array $queryParams): Builder
    {
        $filters = $this->getAllowedFilters($query, $queryParams);

        foreach ($filters as $field => $value) {
            if (is_array($value)) {
                $query->whereIn($field, $value);
                continue;
            }
            if (is_string($value) && str_contains($value, '%')) {
                $query->where($field, 'LIKE', $value);
                continue;
            }
            $query->where($field, $value);
        }
        return $query;
    }

    private function getAllowedFilters(Builder $query, array $queryParams)
    {
        $modelFilters = $query->getModel()->getFilterable();

        return array_filter($queryParams, function ($filter) use ($modelFilters) {
            return in_array($filter, $modelFilters);
        }, ARRAY_FILTER_USE_KEY);
    }
}
