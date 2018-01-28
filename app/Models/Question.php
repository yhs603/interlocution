<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'answers_count', 'views_count', 'followers_count', 'collections_count', 'comments_count', 'status'];

    public function user()
    {
        return $this->belongsTo('Interlocution\Models\User');
    }

    public function tags()
    {
        return $this->morphToMany('Interlocution\Models\Tag', 'taggable');
    }

    public function category()
    {
        return $this->hasOne('Interlocution\Models\Category');
    }

    public function comments()
    {
        return $this->morphMany('Interlocution\Models\Comment', 'commentable');
    }

    public function answers()
    {
        return $this->hasMany('Interlocution\Models\Answer');
    }
}
