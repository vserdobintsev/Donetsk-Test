<?php

namespace Database\Seeders;

use App\Models\SpecificationType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            SpecificationTypeSeeder::class,
            SpecificationSeeder::class,
        ]);
    }
}
