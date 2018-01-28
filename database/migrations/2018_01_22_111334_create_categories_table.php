<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('pid')->default(0)->comment('父级ID');
            $table->string('name')->comment('名称');
            $table->string('alias', 128)->unique()->comment('别名');
            $table->unsignedInteger('sort')->default(0)->comment('排序序号');
            $table->tinyInteger('status')->default(1)->comment('状态:0-未审核1-已审核');
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
        Schema::dropIfExists('categories');
    }
}
