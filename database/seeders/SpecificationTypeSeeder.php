<?php

namespace Database\Seeders;

use App\Models\SpecificationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Цвет',
                'type' => 'color'
            ],
            [
                'name' => 'Вес',
                'type' => 'weight'
            ],
            [
                'name' => 'Высота',
                'type' => 'height'
            ],
            [
                'name' => 'Ширина',
                'type' => 'width'
            ]
        ];
        DB::table(with(new SpecificationType)->getTable())->insert($types);
    }
}
