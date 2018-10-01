<?php

namespace Oxygencms\Menus\Rules;

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Validation\Rule;

class RouteExists implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->value = $value;

        return Route::has($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Route '$this->value' does not exist.'";
    }
}
