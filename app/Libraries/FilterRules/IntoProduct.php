<?php

namespace App\Libraries\FilterRules;

use Illuminate\Database\Eloquent\Builder;

class IntoProduct implements IRulable
{
    public function getPropArray(): array
    {
        return ['price', 'quantity'];
    }
    public function changeQuery(Builder $query, array $options): Builder
    {
        foreach ($options as $k => $v)
            $query->whereIn($k, $v);
        return $query;
    }
}
