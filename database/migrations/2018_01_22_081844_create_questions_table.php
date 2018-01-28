<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('user_id')->default(0)->index()->comment('创建人ID');
            $table->unsignedInteger('category_id')->default(0)->index()->comment('分类ID');
            $table->string('title')->index()->comment('标题');
            $table->text('description')->nullable()->comment('详情');
            $table->unsignedInteger('experience')->default(0)->comment('问题悬赏经验值');
            $table->unsignedInteger('answers_count')->default(0)->comment('回答数');
            $table->unsignedInteger('views_count')->default(0)->comment('查看数');
            $table->unsignedInteger('followers_count')->default(0)->comment('关注数');
            $table->unsignedInteger('collections_count')->default(0)->comment('收藏数');
            $table->unsignedInteger('comments_count')->default(0)->comment('评论数');
            $table->tinyInteger('status')->default(1)->comment('状态：0-待审核1-已审核2-已采纳最优答案');
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
        Schema::dropIfExists('questions');
    }
}
