<?php

namespace App\Http\Controllers\Auth\Actions;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateNewUser
{
    use ValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User|array
     */
    public function create(array $input)
    {
        $validator = Validator::make($input, [
            'first_name' => $this->nameRules(),
            'middle_name' => $this->nameRules(),
            'last_name' => $this->nameRules(),
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class, 'email'),
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^\+7\d{10}$/i',
                'max:255',
                Rule::unique(User::class, 'phone'),
            ],
            'password' => $this->passwordRules(),
        ]);
        if ($validator->fails())
            return $validator->errors()->all();

        $user = User::create([
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
        ]);

        event(new Registered($input));
        return $user;
    }
}
