<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(0)->comment('0表示等待执行，1表示正在执行，2表示执行完成，3表示执行失败');
            $table->string('img_ur')->nullable()->comment('图片的url');
            $table->string('video_url')->nullable()->comment('视频的url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video');
    }
}
