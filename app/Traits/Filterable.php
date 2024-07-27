<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;

trait Filterable
{
    public function filterableColumns(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  $this->filterableColumns
        );
    }

    public function scopeFilter(Builder $query, Request $request, array $filterableColumns): Builder
    {
        $filters = $request->all();

        foreach ($filterableColumns as $column => $type) {
            $query->when(array_key_exists($column, $filters) && $filters[$column], function ($query) use ($filters, $column, $type) {
                if ($type === 'like') {
                    $query->where(function ($q) use ($filters, $column) {
                        $q->orWhere($column, 'LIKE', "%{$filters[$column]}%");
                    });
                } elseif ($type === 'equals') {
                    $query->where($column, $filters[$column]);
                } elseif ($type === 'relation') {
                    $query->whereHas($column, function ($q) use ($filters, $column) {
                        $q->where("{$column}_id", $filters[$column]);
                    });
                }
            });
        }

        return $query;
    }
}
