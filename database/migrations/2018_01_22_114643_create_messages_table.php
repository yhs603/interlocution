<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_user_id')->unsigned()->comment('发送人ID');
            $table->integer('to_user_id')->unsigned()->comment('接收者ID');
            $table->text('content')->comment('消息内容');
            $table->unsignedTinyInteger('is_read')->default(0)->comment('是否查看:1-是0-否');
            $table->unsignedInteger('who_deleted')->comment('删除人ID,必为发送者、接收者二者之一');
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
        Schema::dropIfExists('messages');
    }
}
