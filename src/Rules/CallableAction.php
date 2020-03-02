<?php

namespace Oxygencms\Menus\Rules;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class CallableAction implements Rule
{
    protected $message = null;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  string $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = trim($value);

        if ( ! Str::contains($value, '@') || substr_count($value, '@') != 1) {
            $this->message = "The $attribute format is wrong.";
            return false;
        }

        [$class_name, $method] = explode('@', $value);

        $namespace = app()->getNamespace() . "Http\\Controllers\\";

        if ( ! $class_name == 'PageController') {
            if ( ! class_exists($namespace . $class_name)) {
                $this->message = "Class '" . $namespace . $class_name . "' not found.";
                return false;
            }

            if ( ! is_callable([$namespace . $class_name, $method])) {
                $this->message = "Method @$method is not callable.";
                return false;
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
        return $this->message;
    }
}
