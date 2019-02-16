<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UserRequest;
use App\Models\Image;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * 手机注册登录
     * @param UserRequest $request
     * @return \Dingo\Api\Http\Response|void
     */
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
            'img' => $user->gravatar('450175191@qq.com', 50),
        ]);

        //清除验证码缓存
        \Cache::forget($request->input('verification_key'));

        //return $this->response->created(); //跳转登录页面手动登录
        //注册成功后直接登录
        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60,
            ])
            ->setStatusCode(201);
    }

    /**
     * 获取用户个人信息
     * @return \Dingo\Api\Http\Response
     */
    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }


    public function update(UserRequest $request)
    {
        $user = $this->user();

        $attributes = $request->only(['name', 'email', 'introduction', 'company', 'position', 'work_address']);

        if ($request->avatar_image_id) {
            $image = Image::query()->find($request->avatar_image_id);
            $attributes['img'] = $image->path;
        }
        
        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }
}
