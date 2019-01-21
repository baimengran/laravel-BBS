<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
            [
                'name' => '分享',
                'description' => '分享知识，分享快乐',
                'is_son'=>1,
                'parent_id'=>null,
                'level'=>0,
                'path'=>'-',
            ],
            [
                'name' => '教程',
                'description' => '开发技巧、实用扩展包',
                'is_son'=>1,
                'parent_id'=>null,
                'level'=>0,
                'path'=>'-',
            ],
            [
                'name' => '问答',
                'description' => '互帮互助，团结友爱',
                'is_son'=>1,
                'parent_id'=>null,
                'level'=>0,
                'path'=>'-',
            ], [
                'name' => '公告',
                'description' => '站点公告',
                'is_son'=>1,
                'parent_id'=>null,
                'level'=>0,
                'path'=>'-',
            ],[
                'name' => '新技能',
                'description' => '扩展包、框架、语言、服务器',
                'is_son'=>1,
                'parent_id'=>1,
                'level'=>1,
                'path'=>'-1-',
            ], [
                'name' => '实用技巧',
                'description' => '奇淫巧技也不全是坏事',
                'is_son'=>1,
                'parent_id'=>1,
                'level'=>1,
                'path'=>'-1-',
            ],
            [
                'name' => '奇闻趣闻',
                'description' => '奇闻天下事，趣闻乐不支',
                'is_son'=>1,
                'parent_id'=>1,
                'level'=>1,
                'path'=>'-1-',
            ],[
                'name' => '行业热点',
                'description' => '跟着大佬的脚步有糖吃',
                'is_son'=>1,
                'parent_id'=>1,
                'level'=>1,
                'path'=>'-1-',
            ],[
                'name' => '框架应用',
                'description' => '轮子一定要抡圆了用',
                'is_son'=>1,
                'parent_id'=>2,
                'level'=>1,
                'path'=>'-2-',
            ],[
                'name' => 'PHP',
                'description' => '基础才是王道',
                'is_son'=>1,
                'parent_id'=>2,
                'level'=>1,
                'path'=>'-2-',
            ],[
                'name' => '前端',
                'description' => '页面美不美还得我说了算',
                'is_son'=>1,
                'parent_id'=>2,
                'level'=>1,
                'path'=>'-2-',
            ],[
                'name' => '扩展包',
                'description' => '开源之美',
                'is_son'=>1,
                'parent_id'=>2,
                'level'=>1,
                'path'=>'-2-',
            ],[
                'name' => '框架',
                'description' => '框架的完美应用',
                'is_son'=>1,
                'parent_id'=>3,
                'level'=>1,
                'path'=>'-3-',
            ],[
                'name' => 'PHP',
                'description' => '基础才是王道',
                'is_son'=>1,
                'parent_id'=>3,
                'level'=>1,
                'path'=>'-3-',
            ],[
                'name' => '前端',
                'description' => '语言、框架、JS扩展',
                'is_son'=>1,
                'parent_id'=>3,
                'level'=>1,
                'path'=>'-3-',
            ],[
                'name' => '服务器',
                'description' => 'nginx、apache',
                'is_son'=>1,
                'parent_id'=>3,
                'level'=>1,
                'path'=>'-3-',
            ],

        ];
        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('categories')->truncate();
    }
}
