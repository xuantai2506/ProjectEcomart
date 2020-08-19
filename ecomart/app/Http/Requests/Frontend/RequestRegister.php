<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RequestRegister extends FormRequest
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
            'name'       => 'required|min:5|max:20',
            'email'      => 'required|min:5|email',
            'phone'      => 'required|min:5',
            'password'   => 'required|min:5|required_with:password_confirmation|confirmed',
            'password_confirmation' => 'required'
        ];
    }
      public function messages(){
        return [
            'name.required'  => "Vui lòng nhập tên  !",
            'email.required' => "Vui lòng thêm email !",
            'phone.required' => "Vui lòng thêm số điện thoại !",
            'password.required' => "Vui lòng thêm mật khẩu!",
            'password.confirmed' => "Nhập lại mật khẩu không chính xác",
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
            'min' => ":attribute nhập không được dưới 5 kí tự"
        ];
    }
}
