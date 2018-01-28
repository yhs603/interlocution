<?php

namespace Interlocution\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'mobile', 'name', 'sex', 'birthday', 'province_id', 'city_id', 'country_id', 'address', 'description', 'status', 'confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userExtra()
    {
        return $this->hasOne('Interlocution\Models\UserExtra');
    }

    public function questions()
    {
        return $this->hasMany('Interlocution\Models\Question');
    }

    public function answers()
    {
        return $this->hasMany('Interlocution\Models\Answer');
    }

    public function comments()
    {
        return $this->hasMany('Interlocution\Models\Comment');
    }

    public function collections()
    {
        return $this->hasMany('Interlocution\Models\Collection');
    }

    public function roles()
    {
        return $this->belongsToMany('Interlocution\Models\Role')->withTimestamps();
    }

    public function records()
    {
        return $this->hasMany('Interlocution\Models\Record');
    }

    public function followers()
    {
        return $this->hasMany('Interlocution\Models\Follow');
    }

    public function followings()
    {
        return $this->morphToMany('Interlocution\Models\UserExtra', 'source', 'attentions', 'source_id', 'user_id');
    }
}
