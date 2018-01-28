<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function user()
    {
        return $this->belongsTo('Interlocution\Models\User');
    }
}
