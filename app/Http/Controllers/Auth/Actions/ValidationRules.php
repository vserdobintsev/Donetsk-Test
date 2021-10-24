<?php

namespace App\Http\Controllers\Auth\Actions;

use App\Rules\Password;

trait ValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required', 'string', new Password, 'regex:/^(\p{Latin}+|\d+|\$+|%+|&+|!+|:+|\s)+$/i', 'confirmed'];
    }

    /**
     * Get the validation rules used to validate names.
     *
     * @return array
     */

    protected function nameRules()
    {
        return ['required', 'string', 'max:255'];
    }
}
