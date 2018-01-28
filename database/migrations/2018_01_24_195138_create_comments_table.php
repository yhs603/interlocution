<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->comment('评论内容');
            $table->morphs('commentable');//问题、回答等资源ID和类名
            $table->unsignedInteger('user_id')->comment('评论人ID');
            $table->unsignedInteger('to_user_id')->comment('回复人ID');
            $table->tinyInteger('status')->default(1)->comment('是否显示:1-是0-否');
            $table->unsignedInteger('supports_count')->default(0)->comment('点赞数');
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
        Schema::dropIfExists('comments');
    }
}
