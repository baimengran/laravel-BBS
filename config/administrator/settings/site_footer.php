<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/8
 * Time: 12:15
 */

return[
    'title'=>'站点底部导航设置',

    //访问权限
    'permission' => 'administrator_site_footer_founder',

    //站点配置表单
    'edit_fields' => [
        'site_footer_one_name' => [
            //表单标题
            'title' => '第一栏标题',
            //表单条目类型
            'type' => 'text',
            //字数限制
            'limit' => 50,
        ],
        'site_footer_one_content' => [
            //表单标题
            'title' => '第一栏内容',
            //表单条目类型
            'type' => 'textarea',
            //字数限制
            'limit' => 1000,
        ],
        'site_footer_two_name' => [
            'title' => '第二栏标题',
            'type' => 'text',
            'limit' => 50,
        ],
        'site_footer_two_address' => [
            'title' => '第二栏地址标签',
            'type' => 'text',
            'limit' => 250,
        ],
        'site_footer_two_phone' => [
            'title' => '第二栏电话标签',
            'type' => 'text',
            'limit' => 50,
        ],
        'site_footer_two_email' => [
            'title' => '第二栏邮箱标签',
            'type' => 'text',
            'limit' => 50,
        ],
        'site_footer_three_name' => [
            'title' => '第三栏标题',
            'type' => 'text',
            'limit' => 50,
        ],
        'site_footer_three_content' => [
            'title' => '第三栏内容',
            'hint'=>'上传微信二维码图片',
            'type' => 'image',
            //图片上传路径，
            'location' => public_path() . '/uploads/images/site/',
        ],
        'site_footer_copyright' => [
            'title' => '版权信息',
            'type' => 'textarea',
            'limit' => 250,
        ],
    ],

    //表单验证规则
    'rules' => [
        'site_footer_one_name' => 'required|max:50',
        'site_footer_one_content' => 'required|max:1000',
        'site_footer_two_name' => 'required|max:50',
        'site_footer_two_address' => 'required|max:250',
        'site_footer_two_phone' => 'required|max:50',
        'site_footer_two_email' => 'required|email|max:50',
        'site_footer_three_name' => 'required|max:50',
    ],
    'messages' => [
        'site_footer_one_name.required' => '请填写第一栏标题',
        'site_footer_one_name.max' => '第一栏标题不能超过50个字符',
        'site_footer_one_content.required' => '请填写第一栏内容',
        'site_footer_one_content.max' => '第一栏内容不能超过1000个字符',
        'site_footer_two_name.required' => '请填写第二栏标题',
        'site_footer_two_name.max' => '第二栏标题不能超过50个字符',
        'site_footer_two_address.required' => '请填写第二栏地址标签',
        'site_footer_two_address.max' => '第二栏地址标签不能超过250个字符',
        'site_footer_two_phone.required' => '请填写第二栏电话标签',
        'site_footer_two_phone.max' => '第二栏电话标签不能超过50个字符',
        'site_footer_two_email.required' => '请填写第二栏邮箱标签',
        'site_footer_two_email.max' => '第二栏邮箱标签不能超过50个字符',
        'site_footer_two_email.email' => '请填写正确的第二栏邮箱',
        'site_footer_three_name.required' => '请填写第三栏标题',
        'site_footer_three_name.max' => '第三栏标题不能超过50个字符',
    ],

    //数据即将保存时触发钩子，可以对用户提交的数据做修改
//    'before_save' => function (&$data) {
//        //为网站名称加后缀，加上判断是为防止多次添加
//        if (strpos($data['site_name'], 'Powered By LaraBlogTwo') === false) {
//            $data['site_name'] .= ' - Powered By LaraBlogTwo';
//        }
//    },

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
            'action' => 'administrator_action_site_footer',
        ],
    ],
];