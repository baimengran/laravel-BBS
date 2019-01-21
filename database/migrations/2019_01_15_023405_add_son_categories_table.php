<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSonCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->unsignedTinyInteger('is_son')->after('post_count')->comment('是否允许子类');
            $table->unsignedInteger('parent_id')->nullable()->after('is_son')->comment('父类id');
            $table->unsignedTinyInteger('level')->after('parent_id')->comment('层级');
            $table->string('path')->after('level')->comment('分类路径');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
}
