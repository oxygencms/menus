<?php

namespace Oxygencms\Menus\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $key = $this->isMethod('POST') ? '' : $this->menu->id;

        $rules = [
            'name' => "required|string|unique:menus,name,$key",
            'class' => 'nullable|string',
            'attrs' => 'nullable|string|json',
        ];

        return $rules;
    }
}
