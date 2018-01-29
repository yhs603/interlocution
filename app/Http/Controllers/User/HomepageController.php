<?php

namespace Interlocution\Http\Controllers\User;

use Interlocution\Http\Controllers\Controller;
use Interlocution\Models\Collection;
use Interlocution\Models\Follow;
use Interlocution\Models\User;

class HomepageController extends Controller
{
    protected $user;

    public function __construct()
    {
        parent::__construct();
//        $user_id = request()->route()->parameter('user_id');
//        $user    = User::with('userExtra')->find($user_id);
//        if (!$user) {
//            abort(404);
//        }
//        $this->user = $user;
//        view()->share(['user_info' => $user]);
    }

    /**
     * 我的主页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //增加首页流量次数计数
        $this->user->userExtra()->increment('views_count');

        return view('user.index');
    }

    /**
     * 我的提问
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questions()
    {
        $questions = $this->user->questions()->paginate($this->page_size);

        return view('user.questions', compact('questions'));
    }

    /**
     * 我的回答
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function answers()
    {
        $answers = $this->user->answers()->paginate($this->page_size);

        return view('user.answer', compact('answers'));
    }

    /**
     * 我的关注
     *
     * @param $user_id
     * @param $type
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followed($user_id, $type)
    {
        $classMap = [
            'questions' => 'Interlocution\Models\Question',
            'users'     => 'Interlocution\Models\User',
            'tags'      => 'Interlocution\Models\Tag',
        ];

        if (!isset($classMap[$type])) {
            abort(404);
        }

        switch ($type) {
            case 'questions':
                $follows = Follow::where('followable_type', $classMap[$type])
                    ->leftJoin('questions', 'questions.id', '=', 'follows.followable_id')
                    ->where('follows.user_id', $user_id)
                    ->orderBy('follows.created_at', 'desc')
                    ->paginate($this->page_size);
                break;
            case 'users':
                $follows = Follow::where('followable_type', $classMap[$type])
                    ->leftJoin('users', 'users.id', '=', 'follows.followable_id')
                    ->orderBy('follows.created_at', 'desc')
                    ->where('follows.user_id', $user_id)
                    ->paginate($this->page_size);
                break;
            case 'tags':
                $follows = Follow::where('followable_type', $classMap[$type])
                    ->leftJoin('tags', 'tags.id', '=', 'follows.followable_id')
                    ->orderBy('follows.created_at', 'desc')
                    ->where('follows.user_id', $user_id)
                    ->paginate($this->page_size);
                break;
        }

        return view('user.follow', compact('type', 'follows'));
    }

    /**
     * 我的粉丝
     */
    public function followers($user_id)
    {
        $followers = Follow::where('followable_type', 'Interlocution\Models\User')
            ->leftJoin('users', 'users.id', '=', 'follows.user_id')
            ->where('follows.followable_id', $user_id)
            ->orderBy('follows.created_at', 'desc')
            ->paginate($this->page_size);

        return view('user.follower', compact('followers'));
    }

    /**
     * 我的收藏
     *
     * @param $user_id
     * @param $type
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collected($user_id, $type)
    {
        $classMap = [
            'questions' => 'Interlocution\Models\Question',
            'users'     => 'Interlocution\Models\User',
            'tags'      => 'Interlocution\Models\Tag',
        ];

        if (!isset($classMap[$type])) {
            abort(404);
        }

        switch ($type) {
            case 'questions':
                $follows = Collection::where('collectionable_type', $classMap[$type])
                    ->leftJoin('questions', 'questions.id', '=', 'follows.followable_id')
                    ->where('collection.user_id', $user_id)
                    ->orderBy('collection.created_at', 'desc')
                    ->paginate($this->page_size);
                break;
            case 'users':
                $follows = Collection::where('collectionable_type', $classMap[$type])
                    ->leftJoin('users', 'users.id', '=', 'follows.followable_id')
                    ->orderBy('collection.created_at', 'desc')
                    ->where('collection.user_id', $user_id)
                    ->paginate($this->page_size);
                break;
            case 'tags':
                $follows = Collection::where('collectionable_type', $classMap[$type])
                    ->leftJoin('tags', 'tags.id', '=', 'follows.followable_id')
                    ->orderBy('collection.created_at', 'desc')
                    ->where('collection.user_id', $user_id)
                    ->paginate($this->page_size);
                break;
        }

        return view('user.collect', compact('type', 'follows'));
    }

    /**
     * 我的经验值获取记录
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function experience()
    {
        $experience = $this->user->records()
            ->where('experience', '>', 0)
            ->orderByDesc('created_at')
            ->paginate($this->page_size);

        return view('user.experience', compact('experience'));
    }

    /**
     * 我的天梯分获取记录
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function ladder()
    {
        $ladder = $this->user->records()
            ->where('ladder', '>', 0)
            ->orderByDesc('created_at')
            ->paginate($this->page_size);

        return view('user.ladder', compact('ladder'));
    }
}
