<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('username')->index()->comment('账号');
            $table->string('email', 64)->unique()->comment('邮箱');
            $table->string('mobile', 15)->unique()->nullable()->comment('手机号码');
            $table->string('name')->nullable()->comment('姓名');
            $table->unsignedTinyInteger('sex')->default(0)->nullable()->comment('性别：-1-禁用0-保密1-男2-女');
            $table->date('birthday')->nullable()->comment('生日');
            $table->unsignedInteger('province_id')->nullable()->comment('省');
            $table->unsignedInteger('city_id')->nullable()->comment('市');
            $table->unsignedInteger('county_id')->nullable()->comment('县');
            $table->string('address')->nullable()->comment('详细地址');
            $table->text('description')->nullable()->comment('个人简介');
            $table->tinyInteger('status')->default(0)->comment('状态：-1-禁用0-未激活1-已激活');
            $table->string('password', 64)->comment('密码');
            $table->string('confirmation_token')->comment('激活token');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
