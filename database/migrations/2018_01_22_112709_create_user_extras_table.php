<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_extras', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->unique()->comment('用户ID');
            $table->unsignedInteger('ladder')->default(0)->comment('天梯分');
            $table->unsignedInteger('experience')->default(0)->comment('经验值');
            $table->unsignedInteger('questions_count')->default(0)->comment('提问数');
            $table->unsignedInteger('articles_count')->default(0)->comment('文章数');
            $table->unsignedInteger('answers_count')->default(0)->comment('回答数');
            $table->unsignedInteger('adoptions_count')->default(0)->comment('被采纳个数');
            $table->unsignedInteger('supports_count')->default(0)->comment('赞同数');
            $table->unsignedInteger('followers_count')->default(0)->comment('关注数');
            $table->unsignedInteger('views_count')->default(0)->comment('被访问数');
            $table->timestamp('registered_at')->nullable()->comment('注册时间');
            $table->timestamp('last_login_at')->nullable()->comment('上次登录时间');
            $table->string('last_login_ip')->nullable()->comment('上次登录IP');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_extras');
    }
}
