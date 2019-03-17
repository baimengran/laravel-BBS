<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/8
 * Time: 1:02
 */

use App\Models\Comment;

return [
    'title'=>'回复',
    'single'=>'回复',
    'model'=>Comment::class,

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'content' => [
            'title'    => '内容',
            'sortable' => false,
            'output'   => 'administrator_comments_content',
        ],
        'user' => [
            'title'    => '作者',
            'sortable' => false,
            'output'   => 'administrator_comments_user',
        ],
        'topic' => [
            'title'    => '话题',
            'sortable' => false,
            'output'   => 'administrator_comments_topic',
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'topic' => [
            'title'              => '话题',
            'type'               => 'relationship',
            'name_field'         => 'title',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', title)"),
            'options_sort_field' => 'id',
        ],
        'content' => [
            'title'    => '回复内容',
            'type'     => 'textarea',
        ],
    ],

    'filters' => [
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'topic' => [
            'title'              => '话题',
            'type'               => 'relationship',
            'name_field'         => 'title',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', title)"),
            'options_sort_field' => 'id',
        ],
        'content' => [
            'title'    => '回复内容',
        ],
    ],
    'rules'   => [
        'content' => 'required'
    ],
    'messages' => [
        'content.required' => '请填写回复内容',
    ],
];