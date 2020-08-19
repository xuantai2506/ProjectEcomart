<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class RequestCoreUser extends FormRequest
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
            'user_name' => 'required',
            'password' => 'required|required_with:password_confirmation|confirmed|min:3',
        ];
    }
    public function messages(){
        return [
            'user_name.required' => "Vui lòng nhập tên thành viên",
            'password.required' => 'Vui lòng nhập password',
            'password.required_with:password_confirmation' => "Nhập lại mật khẩu",
            'password.confirmed' => "Nhập sai mật khẩu ",
        ];
    }
}
