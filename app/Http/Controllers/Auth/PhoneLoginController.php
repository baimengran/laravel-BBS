<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\PhoneRegisterRequest;
use App\Jobs\SendSMSCode;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhoneLoginController extends Controller
{
    //

    public function sendCode(PhoneRegisterRequest $request)
    {
        SendSMSCode::dispatch($request->input('phone'));
    }

    public function login(Request $request,User $user)
    {

        $code = \Cache::get($request->input('phone') . '_code');
        \Log::info($code);
        if (!$code) {
            return response('您的验证码已过期', '401');
        }
        //使用hash_equals函数，可防止时序攻击
        if (!hash_equals($code, $request->input('code'))) {
            //返回401
            return response('验证码错误', '401');
        }


       $user =  $user->where('phone', $request->phone)->first();

        if ($user) {
            \Auth::login($user);
            return response('', 201);
        } else {
            return response('当前手机号还没有注册哦', 401);
        }


    }
}
