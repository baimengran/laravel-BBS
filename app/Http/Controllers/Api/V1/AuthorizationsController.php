<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\AuthorizationRequest;
use App\Http\Requests\Api\V1\SocialAuthorizationRequest;
use App\Http\Requests\Api\V1\WeappAuthorizationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class AuthorizationsController extends Controller
{
    /**
     * 第三方登录
     * @param string $type 第三方登录类型
     * @param SocialAuthorizationRequest $request
     */
    public function socialStore($type, SocialAuthorizationRequest $request)
    {

        if (!in_array($type, ['weixin'])) {
            return $this->response->errorBadRequest();
        }

        $driver = Socialite::driver($type);

        try {
            if ($code = $request->input('code')) {
                $response = $driver->getAccessTokenResponse($code);
                $token = array_get($response, 'access_token');
            } else {
                $token = $request->input('access_token');

                if ($type == 'weixin') {
                    $driver->setOpenId($request->input('openid'));
                }
            }

            $oauthUser = $driver->userFromToken($token);
        } catch (\Exception $exception) {
            return $this->response->errorUnauthorized('参数错误，未获取用户信息');
        }

        switch ($type) {
            case 'weixin':
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;

                if ($unionid) {
                    $user = User::query()->where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::query()->where('weixin_openid', $oauthUser->getId())->first();
                }

                if (!$user) {
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        'img' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'weixin_unionid' => $unionid,
                    ]);
                }
                break;
        }
        $token = \Auth::guard('api')->fromUser($user);
        return $this->respondWithToken($token)->setStatusCode(201);
    }

    /**
     * 帐户密码登录
     * @param AuthorizationRequest $request
     */
    public function store(AuthorizationRequest $request)
    {
        $username = $request->input('username');

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;

        $credentials['password'] = $request->input('password');

        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized(trans('auth.failed'));
        }

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    /**
     * 小程序登录
     * @param WeappAuthorizationRequest $request
     */
    public function weappStore(WeappAuthorizationRequest $request)
    {
        $code = $request->code;

        //根据code获取微信openid和session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        //如果结果错误，说明code已过期或不正确，返回401
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code不正确');
        }

        //找到openid对应的用户
        $user = User::query()->where('weapp_openid', $data['openid'])->first();

        $attributes['weixin_session_key'] = $data['session_key'];

        //未找到对应用户则需要提交用户名密码进行用户绑定
        if (!$user) {
            //如果未提交用户名密码，返回403错误提示
            if (!$request->username) {
                return $this->response->errorForbidden('用户不存在');
            }

            $username = $request->username;

            //用户名可以是邮箱或电话
            filter_var($username, FILTER_VALIDATE_EMAIL) ?
                $credentials['email'] = $username :
                $credentials['phone'] = $username;

            $credentials['password'] = $request->password;

            //验证用户名和密码是否正确
            if (!\Auth::guard('api')->once($credentials)) {
                return $this->response->errorUnauthorized('用户名或密码错误');
            }

            //获取对应的用户
            $user = \Auth::guard('api')->getUser();
            $attributes['weapp_openid'] = $data['openid'];
        }
        //更新用户数据
        $user->update($attributes);

        //为对应用户创建JWT
        $token = \Auth::guard('api')->fromUser($user);
        return $this->respondWithToken($token)->setStatusCode(201);
    }

    /**
     * 返回token
     * @param string $token JWT认证token
     * @return mixed
     */
    public function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60,
        ]);
    }

    /**
     * 认证token过期时刷新认证token（Header添加Authorization:Bearer {token}）
     * @return mixed
     */
    public function update()
    {
        $token = \Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    /**
     * 用户退出删除认证token（Header添加Authorization:Bearer {token}）
     * @return \Dingo\Api\Http\Response 204
     */
    public function destroy()
    {
        \Auth::guard('api')->logout();
        return $this->response->noContent();
    }
}
