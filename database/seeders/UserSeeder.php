<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'Владислав',
                'middle_name' => 'Викторович',
                'last_name' => 'Сердобинцев',
                'email' => 'vladislav.serdobintsev@gmail.com',
                'phone' => '+79289579093',
                'password' => '$2y$10$N3ZWBF8So9E0b2QzPnDgi.u8gT6klLw7Ev1dTGaD98qFl6PLPy2rG' // password
            ]
        ];
        DB::table(with(new User)->getTable())->insert($users);
    }
}
