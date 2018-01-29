# interlocution

基于laravel5.5编写。功能上较简单：登录，注册，找回密码，邮件激活，提问，回单问题，评论，收藏，单元测试，后续会逐步完善。

有需要随时联系我，一起交流学习 

- email: 448597483@qq.com


## 使用

```
$ git clone git@github.com:yhs603/interlocution.git
$ composer install
$ cp .env.example .env
$ vim .env
    DB_*
        填写数据库相关配置 your database configuration
    APP_KEY
        php artisan key:generate

$ php artisan migrate
$ php artisan db:seed (默认添加了系统设置，城市表，分类，角色)
$ 因暂时未做提供对应UI进行提问、回答等操作，请使用tinker执行factory中用户、问题、回答等数据便于测试：
    php artisan tinker
    factory(Interlocution\Models\UserExtra::class,50)->create() 
    factory(Interlocution\Models\Answer::class,100)->create() 
```

## TODO
- [ ] 管理后台，提问相关功能

## License

[MIT license](http://opensource.org/licenses/MIT)
