<?php

namespace Interlocution\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Interlocution\Http\Controllers\Controller;
use Interlocution\Models\Collection;
use Interlocution\Models\Question;

class CollectionController extends Controller
{
    /**
     * 收藏问题
     *
     * @param         $id   收藏类型ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function collect($id)
    {
        $subject = Question::find($id);

        if (!$subject) {
            abort(404, '您访问的资源不存在');
        }

        $user = Auth::user();
        //再次收藏等同于取消收藏
        $collect = Collection::where('user_id', $user->id)
            ->where('collectionable_type', get_class($subject))
            ->where('collectionable_id', $id)
            ->first();
        if ($collect) {
            $collect->delete();
            $subject->decrement('collections_count');

            return $this->success('取消收藏成功');
        }

        $collect = Collection::create([
            'user_id'         => $user->id,
            'followable_id'   => $id,
            'followable_type' => get_class($subject),
        ]);

        if ($collect) {
            $subject->increment('collections_count');
        }

        return $this->success('收藏成功');
    }
}
