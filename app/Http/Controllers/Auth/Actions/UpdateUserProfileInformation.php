<?php

namespace App\Http\Controllers\Auth\Actions;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateUserProfileInformation
{
    use ValidationRules;
    /**
     * Validate and update the given user's profile information.
     *
     * @param  App\Models\User  $user
     * @param  array  $input
     * @return bool|array
     */
    public function update($user, array $input)
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
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^\+7\d{10}$/i',
                'max:255',
                Rule::unique(User::class, 'phone')->ignore($user->id),
            ],
        ]);

        if ($validator->fails())
            return $validator->errors()->all();

        $this->updateUser($user, $input);

        return true;
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  App\Models\User  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $this->updateUser($user, $input);

        $user->sendEmailVerificationNotification();
    }
    /**
     * @param  App\Models\User  $user
     * @param  array  $input
     * @return void
     */
    protected function updateUser($user, array $input)
    {
        $user->forceFill([
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
        ])->save();
    }
}
