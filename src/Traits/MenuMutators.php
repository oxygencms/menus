<?php

namespace Oxygencms\Menus\Traits;

trait MenuMutators
{
    /**
     * @param $value
     *
     * @return array|mixed|null
     */
    public function setParamsAttribute($value)
    {
        return $this->attributes['params'] = $this->asJsonFromArray($value);
    }

    /**
     * @param $value
     *
     * @return array|mixed|null
     */
    public function setAttrsAttribute($value)
    {
        return $this->attributes['attrs'] = $this->asJsonFromArray($value);
    }

    /**
     * @param $value
     *
     * @return array|mixed|null
     */
    public function setParentAttrsAttribute($value)
    {
        return $this->attributes['parent_attrs'] = $this->asJsonFromArray($value);
    }

    /**
     * Get JSON string from array or return the original value.
     *
     * @param $value
     *
     * @return mixed
     */
    protected function asJsonFromArray($value)
    {
        return is_array($value) ? json_encode($value) : $value;
    }
}