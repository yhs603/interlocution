# interlocution

基于laravel5.5编写。功能上较简单：登录，注册，找回密码，邮件激活，提问，回单问题，评论，收藏，单元测试，后续会逐步完善。

有需要随时联系我，一起交流学习 

- email: 448597483@qq.com


## 使用

```
$ git clone git@github.com:yhs603/interlocution.git
$ composer install
$ 设置 `storage` 目录必须让服务器有写入权限。
$ cp .env.example .env
$ vim .env
    DB_*
        填写数据库相关配置 your database configuration
    APP_KEY
        php artisan key:generate

$ php artisan migrate
$ php artisan db:seed (默认添加了系统设置，城市表，分类，角色)
```

## TODO
- [ ] 单元测试
- [ ] 管理后台，提问相关功能

## License

[MIT license](http://opensource.org/licenses/MIT)
