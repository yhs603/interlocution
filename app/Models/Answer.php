<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public function comments()
    {
        return $this->morphMany('Interlocution\Models\Comment', 'commentable');
    }

    public function question()
    {
        return $this->hasOne('Interlocution\Models\Question');
    }

    public function user()
    {
        return $this->hasOne('Interlocution\Models\User');
    }
}
