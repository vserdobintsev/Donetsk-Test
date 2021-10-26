<?php
namespace App\Libraries\FilterRules;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface IAfterSQL {
    function afterSQL(Collection $models): SupportCollection;
}
