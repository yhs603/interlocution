<?php

namespace Interlocution\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Interlocution\Http\Controllers\Controller;
use Interlocution\Models\Follow;
use Interlocution\Models\Question;
use Interlocution\Models\Tag;
use Interlocution\Models\User;

class FollowController extends Controller
{
    /**
     * 关注、取消关注为、用户、标签等
     *
     * @param         $type 关注类型
     * @param         $id   关注类型ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow($type, $id)
    {
        $subject = [];
        switch ($type) {
            case 'question':
                $subject = Question::find($id);
                break;
            case 'user':
                $subject = User::find($id);
                break;
            case 'tag':
                $subject = Tag::find($id);
                break;
        }

        if (!$subject) {
            abort(404, '您访问的资源不存在');
        }

        $user = Auth::user();
        //再次关注等同于取消关注
        $follow = Follow::where('user_id', $user->id)
            ->where('followable_type', get_class($subject))
            ->where('followable_id', $id)
            ->first();
        if ($follow) {
            $follow->delete();
            if ($type === 'user') {
                $subject->userExtra->decrement('followers_count');
            } else {
                $subject->decrement('followers_count');
            }

            return $this->success('取消关注成功');
        }

        $follow = Follow::create([
            'user_id'         => $user->id,
            'followable_id'   => $id,
            'followable_type' => get_class($subject),
        ]);

        if ($follow) {
            if ($type == 'user') {
                $subject->userExtra->increment('followers_count');
            } else {
                $subject->increment('followers_count');
            }
        }

        return $this->success('关注成功');

    }
}
