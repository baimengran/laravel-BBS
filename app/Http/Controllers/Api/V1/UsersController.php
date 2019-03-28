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


    public function weappStore(UserRequest $request)
    {
        //缓存中是否存在对应的key
        $verifyData = \Cache::get($request->verification_key);

        if (!$verifyData) {
            return $this->response->error('验证码以失效', 422);
        }

        //判断验证码是否与缓存中一致，不一致返回401
        if (!hash_equals((string)$verifyData['code'], $request->verification_code)) {
            return $this->response->errorUnauthorized('验证码错误');
        }

        //获取微信的openid和session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($request->code);

        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code 不正确');
        }

        //如果openid对应的用户已存在，报错403
        $user = User::query()->where('weapp_openid', $data['openid'])->first();
        if ($user) {
            return $this->response->errorForbidden('微信已绑定其他用户，请直接登录');
        }
        $userimg =  new User();
        //创建用户
        $user = User::create([
            'name' => $request->input('name'),
            'phone' => $verifyData['phone'],
            'img'=>$userimg->gravatar('450175191@qq.com'),
            'password' => bcrypt($request->input('password')),
            'weapp_openid' => $data['openid'],
            'weixin_session_key' => $data['session_key']
        ]);

        //清除验证码缓存
        \Cache::forget($request->verification_key);

        //meta中返回token信息
        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ])->setStatusCode(201);
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

        $attributes = $request->only(['name', 'email', 'introduction', 'company', 'position', 'work_address', 'registration_id']);

        if ($request->avatar_image_id) {
            $image = Image::query()->find($request->avatar_image_id);
            $attributes['img'] = $image->path;
        }

        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * 获取活跃用户
     * @param User $user
     * @return \Dingo\Api\Http\Response
     */
    public function activedIndex(User $user)
    {
        return $this->response->collection($user->getActiveUsers(), new UserTransformer());
    }

    /**
     * 查看用户详细信息
     * @param User $user
     * @return \Dingo\Api\Http\Response
     */
    public function show(User $user){
        return $this->response->item($user,new UserTransFormer());
    }
}
