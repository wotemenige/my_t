<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WechatUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_users', function (Blueprint $table) {
            $table->id();
            $table->string('openid')->comment('用户的openid');
            $table->integer('luck_num')->comment('幸运数字');
            $table->tinyInteger('status')->default(0)->comment('是否中奖0没中奖1中奖');
            $table->string('book_name')->comment('书籍名字');
            $table->string('address')->comment('收货地址');
            $table->string('phone')->comment('手机号');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.22
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
