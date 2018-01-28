<?php

namespace Interlocution\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'answer'          => 'Interlocution\Models\Answer',
            'category'        => 'Interlocution\Models\Category',
            'city'            => 'Interlocution\Models\City',
            'collection'      => 'Interlocution\Models\Collection',
            'message'         => 'Interlocution\Models\Message',
            'permission'      => 'Interlocution\Models\Permission',
            'permission_role' => 'Interlocution\Models\PermissionRole',
            'permission_user' => 'Interlocution\Models\PermissionUser',
            'question'        => 'Interlocution\Models\Question',
            'record'          => 'Interlocution\Models\Record',
            'role'            => 'Interlocution\Models\Role',
            'role_user'       => 'Interlocution\Models\RoleUser',
            'setting'         => 'Interlocution\Models\Setting',
            'tag'             => 'Interlocution\Models\Tag',
            'user'            => 'Interlocution\Models\User',
            'user_extra'      => 'Interlocution\Models\UserExtra',
            'taggable'        => 'Interlocution\Models\Taggable',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
