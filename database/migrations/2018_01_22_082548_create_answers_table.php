<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('question_title')->comment('问题标题');
            $table->integer('question_id')->unsigned()->default(0)->index()->comment('问题ID');
            $table->integer('user_id')->unsigned()->default(0)->index()->comment('提问人ID');
            $table->text('content')->comment('答复详情');
            $table->integer('supports_count')->unsigned()->default(0)->comment('支持数');
            $table->integer('oppositions_count')->unsigned()->default(0)->comment('反对数');
            $table->integer('comments_count')->unsigned()->default(0)->comment('评论数');
            $table->tinyInteger('status')->default(0)->comment('状态:0-待审核1-已审核');
            $table->timestamp('adopted_at')->nullable()->index()->comment('采纳时间');
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
        Schema::dropIfExists('answers');
    }
}
