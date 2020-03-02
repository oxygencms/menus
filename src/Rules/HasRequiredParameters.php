<?php

namespace Oxygencms\Menus\Rules;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class HasRequiredParameters implements Rule
{
    /**
     * @var mixed $route
     */
    protected $route;

    /**
     * @var string $missing
     */
    protected $missing;

    /**
     * @var string $message
     */
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // if no route
        if ( ! $this->route) {
            $this->message = 'The :attribute attribute requires route / action.';
            return false;
        }

        // cancel if the route does not require parameters
        if ( ! $this->route->parameterNames) {
            return true;
        }

        // fail if route requires parameters but none given
        if ( ! $value && $this->route->parameterNames) {
            $this->missing = implode(', ', $this->route->parameterNames);
            return false;
        }

        // fail if required route parameter is missing
        foreach ($this->route->parameterNames as $parameter_name) {

            // skip optional route parameters
            if ( ! Str::contains($this->route->uri, "$parameter_name?}")) {

                $params = json_decode($value, true);

                if ( ! array_key_exists($parameter_name, $params)) {

                    $this->missing = $parameter_name;

                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message ?: 'Missing required route parameter {' . $this->missing . '}.';
    }
}
