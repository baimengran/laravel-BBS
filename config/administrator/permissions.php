<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/7
 * Time: 20:07
 */

use Spatie\Permission\Models\Permission;

return [
    'title' => '权限',
    'single' => '权限',
    'model' => Permission::class,

    'permission' => 'manage_users',

    //对CRUD 动作的单独权限控制，True or False
    'action_permissions' => [
        //控制 新建按钮 的显示
        'create' => 'action_permissions_create',
        'update' => 'action_permissions_update',
        'delete' => 'action_permissions_delete',
        'view' => 'action_permissions_view',
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '标识',
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '标识（谨慎修改）',
            //表单条目标题旁边的提示信息
            'hint' => '修改权限标识会影响代码调用，请谨慎修改',
        ],
        'roles' => [
            'type' => 'relationship',
            'title' => '角色',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'name' => [
            'title' => '标识',
        ],
    ],
];