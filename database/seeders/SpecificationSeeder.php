<?php

namespace Database\Seeders;

use App\Models\Specification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Spec types
         * 1. color
         * 2. weight
         * 3. height
         * 4. width
         */

        /**
         * Products
         * 1. Стул
         * 2. Стол
         * 3. Комод
         */
        $specs = [
            [
                'product_id' => 1,
                'spec_type_id' => 2,
                'value' => '10',
            ],
            [
                'product_id' => 1,
                'spec_type_id' => 3,
                'value' => '1',
            ],
            [
                'product_id' => 1,
                'spec_type_id' => 1,
                'value' => 'red',
            ],
            [
                'product_id' => 1,
                'spec_type_id' => 4,
                'value' => '0.5',
            ],
            [
                'product_id' => 2,
                'spec_type_id' => 2,
                'value' => '10',
            ],
            [
                'product_id' => 2,
                'spec_type_id' => 3,
                'value' => '0.5',
            ],
            [
                'product_id' => 2,
                'spec_type_id' => 1,
                'value' => 'white',
            ],
            [
                'product_id' => 2,
                'spec_type_id' => 4,
                'value' => '2',
            ],
            [
                'product_id' => 3,
                'spec_type_id' => 2,
                'value' => '25',
            ],
            [
                'product_id' => 3,
                'spec_type_id' => 3,
                'value' => '0.5',
            ],
            [
                'product_id' => 3,
                'spec_type_id' => 1,
                'value' => 'white',
            ],
            [
                'product_id' => 3,
                'spec_type_id' => 4,
                'value' => '1.5',
            ],
        ];
        DB::table(with(new Specification)->getTable())->insert($specs);
    }
}
