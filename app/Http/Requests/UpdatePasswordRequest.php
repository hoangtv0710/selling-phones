<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'password' => 'required|min:6|max:255',
            'confirm_password' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải trên 6 ký tự',
            'password.max' => 'Mật khẩu không được nhiều hơn 255 ký tự',
            'confirm_password.required' => 'Vui lòng xác minh lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu không trùng',
        ];
    }
}
