<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 30)->comment('配置名称');
            $table->string('value')->nullable()->comment('配置值');
            $table->string('title', 50)->commment('配置说明');
            $table->string('extra')->comment('配置额外信息');
            $table->tinyInteger('status')->comment('状态:1-可用0-不可用');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
