<?php

namespace App\Libraries;

use App\Libraries\FilterRules\IAfterSQL;
use App\Libraries\FilterRules\IRulable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class EloquentFilter
{
    protected $rules = [];
    public function __construct(array $rules)
    {
        foreach ($rules as $rule)
            if ($rule instanceof IRulable)
                $this->rules[] = $rule;
    }
    public function filter(Builder $query, array $properties): Builder
    {
        foreach ($this->rules as $rule) {
            $options = [];
            $propArray = $rule->getPropArray();
            foreach ($properties as $key => $values)
                if (in_array($key, $propArray))
                    $options[$key] = $values;

            if (count($options) > 0)
                $query = $rule->changeQuery($query, $options);
        }
        return $query;
    }
    public function afterSQL(Collection $models): SupportCollection
    {
        foreach ($this->rules as $rule)
            if ($rule instanceof IAfterSQL)
                $models = $rule->afterSQL($models);
        return $models;
    }
}
