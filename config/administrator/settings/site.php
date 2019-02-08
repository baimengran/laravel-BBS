<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/8
 * Time: 1:26
 */

return [
    'title' => '站点设置',

    //访问权限
    'permission' => function () {
        //只能站长管理站点配置
        return Auth::user()->hasRole('Founder');
    },

    //站点配置表单
    'edit_fields' => [
        'site_name' => [
            //表单标题
            'title' => '站点名称',
            //表单条目类型
            'type' => 'text',
            //字数限制
            'limit' => 50,
        ],
        'contact_email' => [
            'title' => '联系人邮箱',
            'type' => 'text',
            'limit' => 50,
        ],
        'seo_description' => [
            'title' => 'SEO - Description',
            'type' => 'textarea',
            'limit' => 250,
        ],
        'seo_keyword' => [
            'title' => 'SEO - Keywords',
            'type' => 'textarea',
            'limit' => 250,
        ],
        'author' => [
            'title' => '作者',
            'type' => 'text',
            'limit' => 50,
        ],
        'header_logo' => [
            'title' => '头部logo',
            'hint'=>'上传头部图片',
            'type' => 'image',
            //图片上传路径，
            'location' => public_path() . '/uploads/images/site/',
        ],
        'footer_logo' => [
            'title' => '底部logo',
            'hint'=>'上传底部图片',
            'type' => 'image',
            //图片上传路径，
            'location' => public_path() . '/uploads/images/site/',
        ],
    ],

    //表单验证规则
    'rules' => [
        'site_name' => 'required|max:50',
        'contact_email' => 'email',
    ],
    'messages' => [
        'site_name.required' => '请填写站点名称',
        'contact_email.email' => '请填写正确的联系人邮箱',
    ],

    //数据即将保持的触发钩子，可以对用户提交的数据做修改
    'before_save' => function (&$data) {
        //为网站名称加后缀，加上判断是为防止多次添加
        if (strpos($data['site_name'], 'Powered By LaraBlogTwo') === false) {
            $data['site_name'] .= ' - Powered By LaraBlogTwo';
        }
    },

    //定义多种动作，每一个动作作为页面底部的 其他操作 区块
    'actions' => [

        // 清空缓存
        'clear_cache' => [
            'title' => '更新系统缓存',

            // 不同状态时页面的提醒
            'messages' => [
                'active' => '正在清空缓存...',
                'success' => '缓存已清空！',
                'error' => '清空缓存时出错！',
            ],

            // 动作执行代码，注意你可以通过修改 $data 参数更改配置信息
            'action' => function (&$data) {
                \Artisan::call('cache:clear');
                return true;
            }
        ],
    ],
];