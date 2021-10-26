<?php

namespace App\Libraries\FilterRules;

use Illuminate\Database\Eloquent\Builder;

interface IRulable
{
    function getPropArray(): array;
    function changeQuery(Builder $query, array $options): Builder;
}
