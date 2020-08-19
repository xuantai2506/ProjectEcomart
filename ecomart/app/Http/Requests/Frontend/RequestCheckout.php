<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RequestCheckout extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address_detail' => 'required',
            'province' => 'required|not_in:0',
            'district' => 'required|not_in:0',
            'ward' => 'required|not_in:0',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
        ];
    }
}
