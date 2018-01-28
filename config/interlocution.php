<?php
return [
    'page_size'     => 10,
    'send_cloud'    => [
        'email' => env('SEND_CLOUD_EMAIL'),
        'name'  => env('SEND_CLOUD_NAME')
    ],
    'record_action' =>
        [
            'ask'         => '提问',
            'answer'      => '回答问题',
            'adopted'     => '回答被采纳',
            'login'       => '登录',
            'register'    => '注册',
            'mobile'      => '完善手机号',
            'birthday'    => '完善出生日期',
            'address'     => '完善家庭住址',
            'description' => '完善自我简介',
            'avatar'      => '上传头像',
            'name'        => '完善真实姓名',
        ]
];