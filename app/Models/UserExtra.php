<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;

class UserExtra extends Model
{
    public $timestamps = FALSE;
    protected $fillable = ['user_id', 'ladder', 'experience', 'questions_count', 'articles_count', 'answers_count', 'adoptions_count', 'supports_count', 'followers_count', 'views_count', 'registered_at'];
}
