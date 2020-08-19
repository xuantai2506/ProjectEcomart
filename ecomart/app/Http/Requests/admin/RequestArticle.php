<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class RequestArticle extends FormRequest
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
            'name' => 'required|min:3',
            'images' => 'required',
            'title' => 'required|min:5',
            'comment' => 'required|min:5',
            'is_active' => 'required',
            'hot' => 'required'
        ];
    }
    public function messages(){
        return [
            'name.required' => "Vui lòng nhập tên bài viết !",
            'images.required' => "Vui lòng thêm hình ảnh !",
            'title.required' => "Vui lòng thêm tiêu đề bài viết !",
            'comment.required' => "Vui lòng thêm phần mô tả !",
            'is_active.required' => "Vui long lựa chọn hiển thị !",
            'hot.required' => "Vui lòng lựa chọn nổi bật",
        ];
    }
     
}
