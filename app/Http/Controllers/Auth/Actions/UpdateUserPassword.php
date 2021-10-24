<?php

namespace App\Http\Controllers\Auth\Actions;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdateUserPassword
{
    use ValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  App\Models\User  $user
     * @param  array  $input
     * @return bool|array
     */
    public function update($user, array $input)
    {
        $validator = Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $input) {
            if (!isset($input['current_password']) || !Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        });
        if ($validator->fails())
            return $validator->errors()->all();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        return true;
    }
}
