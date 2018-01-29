<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//用户登录、注册、修改密码
Auth::routes();
//欢迎页
Route::get('/', 'HomeController@welcome')->name('welcome');
//首页
Route::get('/home', 'HomeController@index')->name('home');
//激活账号验证邮箱
Route::get('email/verify/{token}', 'Web\UserController@verify')->name('email.verify');

Route::Group(['namespace' => 'Web'], function () {
    Route::Group(['middleware' => ['auth', 'user.valid']], function () {
        //答案采纳
        Route::get('answer/adopt/{id}', 'AnswerController@adopt')->where('id', '[0-9]+')->name('answer.adopt');
        //问题
        Route::resource('question', 'QuestionController');
        //答案
        Route::resource('answer', 'AnswerController');
        //评论
        Route::resource('comment', 'CommentController');
        //标签
        Route::resource('tag', 'TagController');

        //获取省份
        Route::get('city/province', 'CityController@ajaxProvinceList');
        Route::get('city/city/{pid}', 'CityController@ajaxCityList')->where(['pid' => '[0-9]+']);
        Route::get('city/district/{pid}', 'CityController@ajaxDistrictList')->where(['pid' => '[0-9]+']);
    });
});

Route::Group(['namespace' => 'User'], function () {
    //个人首页
    Route::get('user/{user_id}', 'HomepageController@index')->where(['user_id' => '[0-9]+'])->name('user.homepage.index');
    //我的提问
    Route::get('user/{user_id}/questions', 'HomepageController@questions')->where(['user_id' => '[0-9]+'])->name('user.homepage.questions');
    //我的回答
    Route::get('user/{user_id}/answers', 'HomepageController@answers')->where(['user_id' => '[0-9]+'])->name('user.homepage.answers');
    //我的粉丝
    Route::get('user/{user_id}/followers', 'HomepageController@followers')->where(['user_id' => '[0-9]+'])->name('user.homepage.followers');
    //我的关注
    Route::get('user/{user_id}/followed/{type}', 'HomepageController@followed')->where(['user_id' => '[0-9]+', 'type' => '(questions|tags|users)'])->name('user.homepage.followed');
    //我的收藏
    Route::get('user/{user_id}/collected/{type}', 'HomepageController@collections')->where(['user_id' => '[0-9]+', 'type' => '(questions|articles)'])->name('user.homepage.collections');
    //我的经验记录
    Route::get('user/{user_id}/experience', 'HomepageController@experience')->where(['user_id' => '[0-9]+'])->name('user.homepage.experience');
    //我的天梯分记录
    Route::get('user/{user_id}/ladder', 'HomepageController@credits')->where(['user_id' => '[0-9]+'])->name('user.homepage.ladder');
    //关注问题、人、标签
    Route::get('follow/{type}/{id}', 'FollowController@follow')->where(['type' => '(question|tag|user)', 'id' => '[0-9]+'])->name('user.follow');
    //收藏问题
    Route::get('collect/{id}', 'CollectionController@collect')->where(['id' => '[0-9]+'])->name('user.collect');
});
