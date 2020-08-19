<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class RequestCategory extends FormRequest
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
        return [
            'name' => "required",
            'type_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Vui lòng nhập tên danh mục",
            'type_id.required' => 'Vui lòng lựa chọn danh mục'
        ];
    }
}
