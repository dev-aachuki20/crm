<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class NoMultipleSpacesRule implements Rule
{
    public function passes($attribute, $value)
    {
        return !preg_match('/\s{2,}/', $value);
    }

    public function message()
    {
        return 'The :attribute may only contain one space between words.';
    }
}
