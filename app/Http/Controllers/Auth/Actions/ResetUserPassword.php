<?php

namespace App\Http\Controllers\Auth\Actions;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetUserPassword
{
    use ValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  App\Models\User  $user
     * @param  array  $input
     * @return bool|array
     */
    public function reset($user, array $input)
    {
        $validator = Validator::make($input, [
            'password' => $this->passwordRules(),
        ]);
        if ($validator->fails())
            return $validator->errors()->all();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
        return true;
    }
}
