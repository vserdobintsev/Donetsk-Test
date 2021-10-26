<?php

namespace App\Http\Controllers;

use App\Libraries\EloquentFilter;
use App\Libraries\FilterRules\IntoProduct;
use App\Libraries\FilterRules\IntoSpecs;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $properties = $request->query('properties');

        $ef = new EloquentFilter([new IntoProduct, new IntoSpecs]);
        $products = Product::when($properties, function ($query, $properties) use($ef) {
            return $ef->filter($query, $properties);
        })->get();
        $products = $ef->afterSQL($products);
        return new LengthAwarePaginator($products, count($products), 40, $request->get('page'));
    }
}
