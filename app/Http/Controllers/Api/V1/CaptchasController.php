<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;

class CaptchasController extends Controller
{
    //

    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-' . str_random(15);
        $phone = $request->input('phone');

        //创建验证图片
        $captcha = $captchaBuilder->build();
        //设定缓存过期时间
        $expiredAt = now()->addMinutes(10);
        //将手机号码与图片验证码文本存入缓存
        \Cache::put($key, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline(),//base64图片验证码
        ];

        return $this->response->array($result)->setStatusCode(201);
    }
}
