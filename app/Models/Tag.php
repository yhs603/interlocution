<?php

namespace Interlocution\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['id', 'pid', 'category_id', 'name', 'path', 'summary', 'description', 'followers_count'];

    public function questions()
    {
        return $this->morphedByMany('Interlocution\Models\Question', 'toggable');
    }

    /**
     * 批量添加标签
     *
     * @param $tags
     * @param $question
     *
     * @return array
     */
    public static function multiCreate($tags, $question)
    {
        $tags = array_unique(explode(",", $tags));

        foreach ($tags as $name) {

            if (!trim($name)) continue;
            $tag = self::firstOrCreate(['name' => $name]);

            if (!$question->tags->contains($tag->id)) {
                $question->tags()->attach($tag->id);
            }
        }

        return $tags;
    }
}
