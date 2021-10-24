<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $properties = $request->query('properties');

        return Product::when($properties, function ($query, $properties) {
            foreach ($properties as $k => $v)
                $query->whereIn($k, $v);
        })->paginate(40);
    }
}
