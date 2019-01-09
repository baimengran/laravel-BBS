<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ];
    }

//    public function messages()
//    {
//        return [
//            'name.required' => '用户名不能为空',
//            'name.max' => '',
//            'email.required' => '',
//            'email.email' => '',
//            'email.unique' => '',
//            'email.max' => '',
//            'password.required' => '',
//            'password.confirmed' => '',
//            'password.min' => '密码不能少于6位',
//        ];
//    }
}
