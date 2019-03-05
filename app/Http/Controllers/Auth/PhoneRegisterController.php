<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\PhoneRegisterRequest;
use App\Jobs\SendSMSCode;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhoneRegisterController extends Controller
{
    //

    public function sendCode(PhoneRegisterRequest $request)
    {
        SendSMSCode::dispatch($request->input('phone'));
    }


    public function store(Request $request)
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

        $user = new User();
        $user = User::create([
            'name' => $request->input('phone'),
            'phone' => $request->input('phone'),
            'img' => $user->gravatar('450175191@qq.com', 50),
        ]);

        \Cache::forget($request->input('phone').'_code');

        \Auth::login($user);
        return response('',201);
    }
}
