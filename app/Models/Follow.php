<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['user_id', 'followable_id', 'followable_type'];
}
