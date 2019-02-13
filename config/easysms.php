<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/13
 * Time: 19:12
 */

use Overtrue\EasySms\Strategies\OrderStrategy;

return [
    //HTTP 请求超时时间（秒）
    'timeout'=>5.0,

    //默认发送配置
    'default'=>[
        //网关调用策略，默认：顺序调用
        'strategy'=>OrderStrategy::class,

        //默认可用的发送网关
        'gateways'=>[
            'yunpian',
        ],
    ],

    //可用网关配置
    'gateways'=>[
        'errorlog'=>[
            'file'=>'/tmp/easy-sms.log',
        ],
        'yunpian'=>[
            'api_key'=>env('YUNPIAN_API_KEY'),
        ],
    ],
];