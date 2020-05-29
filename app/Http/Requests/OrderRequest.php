<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required|numeric|min:10',
            'address' => 'required|min:5',
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
            'phone.required' => 'Số điện thoại không được bỏ trống',
            'phone.numeric' => 'Số điện thoại không hợp lệ',
            'phone.min' => 'Số điện thoại phải gồm 10 số',
            'address.required' => 'Địa chỉ nhận hàng không được bỏ trống',
            'address.min' => 'Địa chỉ tối thiểu 5 ký tự',
        ];
    }
}
