<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'name'   => 'ladder_ask',
                'value'  => '5',
                'title'  => '提问获取天梯分值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'ladder_answer',
                'value'  => '10',
                'title'  => '回答问题获取天梯分值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'ladder_adopt',
                'value'  => '20',
                'title'  => '回答被采纳获取天梯分值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'experience_ask',
                'value'  => '5',
                'title'  => '提问获取天梯分值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'experience_answer',
                'value'  => '10',
                'title'  => '回答问题获取天梯分值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'experience_adopt',
                'value'  => '20',
                'title'  => '回答被采纳获取天梯分值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'experience_login',
                'value'  => '10',
                'title'  => '登录获取经验值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'experience_register',
                'value'  => '20',
                'title'  => '提问获取天梯分',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'consummate_mobile',
                'value'  => '20',
                'title'  => '完善手机号获取经验值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'consummate_birthday',
                'value'  => '5',
                'title'  => '完善出生日期获取经验值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'consummate_sex',
                'value'  => '5',
                'title'  => '完善性别获取经验值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'consummate_address',
                'value'  => '10',
                'title'  => '完善家庭住址获取经验值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'consummate_description',
                'value'  => '5',
                'title'  => '完善自我简介获取经验值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'consummate_avatar',
                'value'  => '20',
                'title'  => '上传头像获取经验值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'consummate_name',
                'value'  => '5',
                'title'  => '完善真实姓名获取经验值',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'question_limit_num_per_hour',
                'value'  => '0',
                'title'  => '每小时限制发布问题数量，0为不限制',
                'extra'  => '',
                'status' => 1,
            ],
            [
                'name'   => 'answer_limit_num_per_hour',
                'value'  => '0',
                'title'  => '每小时限制回单问题数量，0为不限制',
                'extra'  => '',
                'status' => 1,
            ],
        ]);
    }
}
