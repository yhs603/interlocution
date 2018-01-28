<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    //

    public function questions()
    {
        return $this->hasMany('Interlocution\Models\Question');
    }

    public static function categories()
    {
        $categories = Cache::rememberForever('categories', function () {
            return self::where('status', 1)->select('id', 'name')->orderBy('sort')->orderBy('created_at')->get();
        });

        return $categories;
    }
}
