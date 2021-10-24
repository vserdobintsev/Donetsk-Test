<?php

namespace App\Http\Controllers\Auth\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LoginUser
{
    use ValidationRules;

    /**
     * Validate and login a registered user.
     *
     * @param  array  $input
     * @return \Laravel\Sanctum\NewAccessToken|array
     */
    public function check(array $input)
    {
        $validator = Validator::make($input, [
            'login' => $this->nameRules(),
            'password' => array_slice($this->passwordRules(), 0, 2),
        ]);
        if ($validator->fails())
            return $validator->errors()->all();

        $user = User::where('email', $input['login'])
            ->orWhere('phone', $input['login'])->first();

        if (blank($user))
            return [
                'Login incorrect.'
            ];

        if (!Hash::check($input['password'], $user->password))
            return [
                'Password incorrect.'
            ];

        return $user->createToken(uniqid());
    }
}
