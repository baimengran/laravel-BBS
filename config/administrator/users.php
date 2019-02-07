<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/7
 * Time: 5:27
 */

use App\Models\User;

return [
    //页面标题
    'title' => '用户',

    //模型单数 用作页面【新建 $single】
    'single' => '用户',

    //数据模型 用作数据的CRUD
    'model' => User::class,

    //设置当前页面的访问权限，通过返回布尔值来控制权限
    //返回true 即通过权限验证，false 则无权访问并从Menu中隐藏
    'permission' => function () {
        return Auth::user()->can('manage_users');
    },

    //字段负责渲染【数据列表】 由user表中的列组成
    'columns' => [
        //列的标示，这是最小化列信息配置的例子，读取的是模型里对应的属性的值，如$model->id
        'id',

        'img' => [
            //数据表格里列的名称，默认使用列标示
            'title' => '头像',

            //默认直接输出数据，也可以使用output选项定制输出内容
            'output' => function ($img, $model) {
                return empty($img) ? 'N/A' : '<img src="' . $img . '" width="40">';
            },

            //是否允许排序
            'sortable' => false,
        ],

        'name' => [
            'title' => '用户名',
            'sortable' => false,
            'output' => function ($name, $model) {
                return '<a href="/users/' . $model->id . '" target=_blank>' . $name . '</a>';
            },
        ],

        'email' => [
            'title' => '邮箱',
        ],

        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    //模型表单设置项
    'edit_fields' => [
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱',
        ],
        'password' => [
            'title' => '密码',
            //表单使用input类型password
            'type' => 'password',
        ],
        'img' => [
            'title' => '用户头像',
            //设置表单类型，默认type为input
            'type' => 'image',
            //图片上传路径，
            'location' => public_path() . '/uploads/images/avatars/',
        ],
        'roles' => [
            'title' => '用户角色',
            //指定数据的类型为关联类型
            'type' => 'relationship',
            //关联模型的字段，用来做关联显示
            'name_field' => 'name',
        ],
    ],

    //数据过滤设置
    'filters' => [
        'id' => [
            'title' => '用户ID',
        ],
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱',
        ],
    ],
];