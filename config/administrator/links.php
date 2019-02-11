<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/9
 * Time: 18:50
 */

use App\Models\Link;

return [
    'title' => '资源推荐',
    'single' => '资源推荐',
    'model' => Link::class,

    //访问权限
    'permission' => function () {
        //只允许站长管理
        return Auth::user()->hasRole('Founder');
    },

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title' => '名称',
            'sortable' => false,
        ],
        'link' => [
            'title' => '链接',
            'sortable' => false,
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'title' => [
            'title' => '名称',
        ],
        'link' => [
            'title' => '链接',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => '标签 ID',
        ],
        'title' => [
            'title' => '名称',
        ],
    ],
];