<?php

namespace Oxygencms\Menus\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmptyWhen implements Rule
{
    /**
     * @var array $fields
     */
    protected $fields;

    /**
     * @var string $failed
     */
    protected $failed;

    /**
     * Create a new rule instance.
     *
     * @param array $fields
     */
    public function __construct(...$fields)
    {
        $this->fields = is_array($fields[0]) ? array_flatten($fields) : $fields;
    }

    /**
     * The attribute under validation must be empty when
     * one of the fields passed to the rule has value.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->fields as $field) {
            if (request()->get($field) && $value) {
                $this->failed = $field;

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
        return "The :attribute must be empty if $this->failed is set.";
    }
}
