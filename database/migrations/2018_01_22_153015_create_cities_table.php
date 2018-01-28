<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('code', 6)->comment('编码');
            $table->string('name', 30)->comment('名称');
            $table->unsignedInteger('pid')->comment('父级ID');
            $table->string('short_name', 30)->comment('简称');
            $table->unsignedTinyInteger('level_type')->comment('级别：0-国家1-省2-市3-县');
            $table->string('city_code', 30)->comment('区号');
            $table->string('zip_code', 30)->comment('邮政编码');
            $table->string('merger_name', 30)->comment('全称');
            $table->string('lng', 30)->comment('经度');
            $table->string('lat', 30)->comment('纬度');
            $table->string('pinyin', 30)->comment('拼音简称');
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
        Schema::dropIfExists('cities');
    }
}
