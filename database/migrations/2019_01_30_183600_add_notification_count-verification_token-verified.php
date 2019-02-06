<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotificationCountVerificationTokenVerified extends Migration
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
            $table->unsignedInteger('notification_count')->default(0)->comment('通知数量');
            $table->string('verification_token')->nullable()->comment('邮箱验证token');
            $table->boolean('verified')->default(false)->comment('是否已经邮箱验证');
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
            $table->dropColumn('notification_count');
            $table->dropColumn('verification_token');
            $table->dropColumn('verified');
        });
    }
}
