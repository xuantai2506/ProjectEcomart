<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RequestLogin extends FormRequest
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
            'email' => 'required|min:5|email',
            'password' => 'required|min:5'
        ];
    }
    public function messages(){
        return [
            'email.required' => "Vui lòng thêm email !",
            'password.required' => "Vui lòng thêm mật khẩu!",
            'min' => ":attribute nhập không được dưới 5 kí tự"
        ];
    }
}
