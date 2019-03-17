<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/7
 * Time: 20:39
 */

use App\Models\Category;

return [
    'title' => '分类',
    'single' => '分类',
    'model' => Category::class,

    //对CRUD 动作的单独权限控制 True or False 默认True
    'action_permissions' => [
        //删除
        'delete' => 'administrator_categories_founder'
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '名称',
            'sortable' => false,
        ],
        'level' => [
            'title' => '分类层级',
            'sortable' => false,
        ],
        'is_son' => [
            'title' => '是否允许子类',
            'output' => 'administrator_categories_is_son',
            'sortable' => false,
        ],
        'description' => [
            'title' => '描述',
            'sortable' => false,
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],
//TODO
    'edit_fields' => [
        'name' => [
            'title' => '名称',
        ],
//        'parent_id' => [
//            'title'              => '父分类',
//            'type'               => 'relationship',
//            'name_field'         => 'name',
//
//            // 自动补全，对于大数据量的对应关系，推荐开启自动补全，
//            // 可防止一次性加载对系统造成负担
//            'autocomplete'       => true,
//
//            // 自动补全的搜索字段
//            'search_fields'      => ["CONCAT(id, ' ', name)"],
//
//            // 自动补全排序
//            'options_sort_field' => 'id',
//        ],
        'description' => [
            'title' => '描述',
            'type' => 'textarea',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => '分类 ID',
        ],
        'name' => [
            'title' => '名称',
        ],
        'description' => [
            'title' => '描述',
        ],
    ],

    'rules' => [
        'name' => 'required|min:1|unique:categories'
    ],
    'messages' => [
        'name.unique' => '分类名在数据库里有重复，请选用其他名称。',
        'name.required' => '请确保名字至少一个字符以上',
    ],
];