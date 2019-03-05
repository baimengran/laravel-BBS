<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneRegisterRequest extends FormRequest
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
        switch($this->route()->getName()){
            case 'register.phone.send.code':
                return [
                    'phone' => 'required|regex:/^1[34578]\d{9}$/|unique:users',
                    'captchaPhone' => 'required|captcha',
                ];
                break;
            case 'login.phone.send.code':
                return [
                    'phone' => 'required|regex:/^1[34578]\d{9}$/|exists:users,phone',
                    'captchaPhone' => 'required|captcha',
                ];
                break;
        }

    }

    public function messages()
    {
        return [
            'captchaPhone.required'=>'图片验证码不能为空',
            'captchaPhone.captcha'=>'图片验证码错误',
        ];
    }
}
