<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RequestResetPass extends FormRequest
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
            'password' => 'required|min:3',
            'password_confirmed' => 'required|same:password'
        ];
    }
    public function messages(){
        return [
            'password.required' => 'Vui lòng nhập password',
            'password_confirmed.required' => 'Vui lòng nhập password',
            'password_confirmed.same' => "Mât khẩu nhập lại không chính xác ",
        ];
    }
}
