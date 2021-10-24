<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->firstNameMale(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this-> faker->regexify('+7[0-9]{10}'),
            'password' => '$2y$10$N3ZWBF8So9E0b2QzPnDgi.u8gT6klLw7Ev1dTGaD98qFl6PLPy2rG', // password
            'remember_token' => Str::random(10),
        ];
    }
}
