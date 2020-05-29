<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:2|max:255|',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:255',
            'confirm_password' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được bỏ trống',
            'name.min' => 'Họ tên tối thiểu có 2 ký tự',
            'name.max' => 'Họ tên tối đa có 255 ký tự',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu tối thiểu có 6 ký tự',
            'password.max' => 'Mật khẩu tối đa có 255 ký tự',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu',
            'confirm_password.same' => 'Không trùng với trường mật khẩu',
        ];
    }
}
