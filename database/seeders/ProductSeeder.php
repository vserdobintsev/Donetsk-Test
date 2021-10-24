<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Стул',
                'price' => 500.0,
                'quantity' => 10,
            ],
            [
                'name' => 'Стол',
                'price' => 1500.0,
                'quantity' => 3,
            ],
            [
                'name' => 'Комод',
                'price' => 3200.0,
                'quantity' => 1,
            ]
        ];
        DB::table(with(new Product)->getTable())->insert($products);
    }
}
