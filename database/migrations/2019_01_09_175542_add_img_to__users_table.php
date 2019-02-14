<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImgToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('phone')->nullable()->unique()->after('email')->comment('手机');
            $table->string('img')->nullable()->after('remember_token')->comment('头像');
            $table->string('introduction')->nullable()->after('img')->comment('简介');
            $table->string('company')->nullable()->after('introduction')->comment('公司');
            $table->string('position')->nullable()->after('company')->comment('职位');
            $table->string('work_address')->nullable()->after('position')->comment('工作地点');
            $table->unsignedInteger('notification_count')->after('work_address')->default(0)->comment('通知数量');
            $table->string('verification_token')->nullable()->after('notification_count')->comment('邮箱验证token');
            $table->boolean('verified')->default(false)->after('verification_token')->comment('是否已经邮箱验证');
            //最后活跃时间字段
            $table->timestamp('last_actived_at')->after('verified')->nullable()->comment('最后活跃时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('phone');
            $table->dropColumn('img');
            $table->dropColumn('introduction');
            $table->dropColumn('company');
            $table->dropColumn('position');
            $table->dropColumn('work_address');
            $table->dropColumn('notification_count');
            $table->dropColumn('verification_token');
            $table->dropColumn('verified');
            $table->dropColumn('last_actived_at');
        });
    }
}
