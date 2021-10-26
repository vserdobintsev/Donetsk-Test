<?php

namespace App\Libraries\FilterRules;

use App\Models\Product;
use App\Models\Specification;
use App\Models\SpecificationType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use KSamuel\FacetedSearch\Filter\ValueFilter;
use KSamuel\FacetedSearch\Index;
use KSamuel\FacetedSearch\Search;

class IntoSpecs implements IRulable, IAfterSQL
{
    protected $options = [];
    public function getPropArray(): array
    {
        return SpecificationType::select('type')->get()->pluck('type')->toArray();
    }
    public function changeQuery(Builder $query, array $options): Builder
    {
        $this->options = $options;
        $productsTable = with(new Product)->getTable();
        $specificationsTable = with(new Specification)->getTable();
        $specificationTypesTable = with(new SpecificationType)->getTable();

        return $query->select(["{$productsTable}.*", 'type', 'value'])->rightJoin(
            $specificationsTable,
            function ($join) use ($options, $productsTable, $specificationsTable) {
                $join->on(
                    "{$productsTable}.id",
                    '=',
                    "{$specificationsTable}.product_id"
                );
                $join->whereIn('value', array_values($options));
            }
        )
            ->rightJoin(
                $specificationTypesTable,
                function ($join) use ($options, $specificationsTable, $specificationTypesTable) {
                    $join->orOn(
                        "{$specificationsTable}.spec_type_id",
                        '=',
                        "{$specificationTypesTable}.id"
                    );
                    $join->whereIn('type', array_keys($options));
                }
            )
            ->where(function ($query) use ($options) {
                foreach ($options as $key => $values)
                    $query->orWhere(function ($query) use ($key, $values) {
                        $query->where('type', $key);
                        $query->whereIn('value', $values);
                    });
            })->groupBy("{$specificationsTable}.id");
    }
    public function afterSQL(Collection $models): SupportCollection
    {
        $index = new Index;
        foreach ($models as $model)
            $index->addRecord($model->id, [$model->type => $model->value]);

        $filters = [];
        foreach ($this->options as $key => $value)
            $filters[] = new ValueFilter($key, $value);
        
        $list = (new Search($index))->find($filters);
        $options = $this->options;
        return $models->filter(function ($model, $key) use ($list) {
            return in_array($model->id, $list);
        })->unique('id')->map(function ($model) use ($options) {
            foreach ($options as $k => $v)
                $model->makeHidden($k);
            $model->makeHidden('type');
            $model->makeHidden('value');
            return $model;
        });
    }
}
