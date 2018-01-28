<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name'        => '超级管理员',
                'type'        => 1,
                'description' => '超级管理员，具有最高权限',
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now()
            ],
            [
                'name'        => '注册会员',
                'type'        => 2,
                'description' => '普通注册会员',
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now()
            ],
        ]);
    }
}
