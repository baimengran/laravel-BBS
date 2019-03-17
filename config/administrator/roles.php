<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/7
 * Time: 19:52
 */

use Spatie\Permission\Models\Role;

return [
    'title' => '角色',
    'single' => '角色',
    'model' => Role::class,

    'permission' => 'manage_users',

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '标识',
        ],
        'permissions' => [
            'title' => '权限',
            'output' => 'administrator_roles_permissions',
            'sortable' => false,
        ],
        'operation' => [
            'title' => '管理',
            'output' => 'administrator_roles_operation',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '标识',
        ],
        'permissions' => [
            'type' => 'relationship',
            'title' => '权限',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '标识'
        ],
    ],

    //新建和编辑时，表单验证规则
    'rules' => [
        'name' => 'required|max15|unique:roles,name',
    ],

    //表单验证错误消息
    'messages' => [
        'name.required' => '标识不能为空',
        'name.unique' => '标识已存在',
    ],
];