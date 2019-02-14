<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function store(UserRequest $request)
    {
        $verificationData = \Cache::get($request->input('verification_key'));

        if (!$verificationData) {
            return $this->response->error('验证码已失效', 422);
        }
        //使用hash_equals函数，可防止时序攻击
        if (!hash_equals($verificationData['code'], $request->input('verification_code'))) {
            //返回401
            return $this->response->errorUnauthorized('验证码错误');
        }
        $user = new User();
        $user = User::create([
            'name' => $request->input('name'),
            'phone' => $verificationData['phone'],
            'password' => bcrypt($request->input('password')),
            'img'=>$user->gravatar('450175191@qq.com',50),
        ]);

        //清除验证码缓存
        \Cache::forget($request->input('verification_key'));

        return $this->response->created();
    }
}
