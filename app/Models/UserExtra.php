<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;

class UserExtra extends Model
{
    public $timestamps = FALSE;
    protected $fillable = ['user_id', 'experience', 'registered_at'];
}
