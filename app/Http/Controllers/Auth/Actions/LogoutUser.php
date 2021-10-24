<?php

namespace App\Http\Controllers\Auth\Actions;

use App\Models\User;

class LogoutUser
{

    /**
     * Logout user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function logout(User $user)
    {
        $user->currentAccessToken()->delete();
    }
}
