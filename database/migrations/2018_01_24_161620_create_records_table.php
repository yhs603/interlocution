<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('user_id')->index()->comment('用户ID');
            $table->string('action', 30)->comment('相关操作名');
            $table->unsignedInteger('ladder')->default(0)->comment('获取天梯分值');
            $table->unsignedInteger('experience')->default(0)->comment('获取经验值');
            $table->timestamp('created_at')->comment('获取时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
