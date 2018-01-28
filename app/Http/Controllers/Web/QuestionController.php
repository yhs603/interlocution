<?php

namespace Interlocution\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Interlocution\Http\Controllers\Controller;
use Interlocution\Models\Category;
use Interlocution\Models\Question;
use Interlocution\Models\Record;
use Interlocution\Models\Setting;
use Interlocution\Models\Tag;
use Interlocution\Models\User;

class QuestionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::where('status', '>', 0)->paginate($this->page_size);

        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        //对某人提问时需要输出对应姓名等信息
        $to             = $request->get('to', 0);
        $to_user        = User::find($to);
        $all_categories = Category::categories();

        return view('question.create', compact('to_user', 'all_categories'));
    }

    /**
     * 发布问题
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            $question_limit_num_per_hour = (int)Setting::byName('question_limit_num_per_hour');
            $question_count              = $this->cacheCounter('question_num_' . $user->id);
            if ($question_limit_num_per_hour > 0 && $question_count > $question_limit_num_per_hour) {
                throw new \Exception('发布问题过于频繁，请一小时后重试');
            }

            Validator::make($request->all(), [
                'title'       => 'required|min:2|max:255',
                'description' => 'min:8|max:65535',
                'tags'        => 'string|max:128',
                'category_id' => 'numeric',
                'experience'  => 'digits_between:0,100',
            ]);

            $data = [
                'user_id'     => $user->id,
                'category_id' => $request->get('category_id', 0),
                'title'       => $request->get('title'),
                'description' => clean($request->get('description')),
                'experience'  => $request->get('experience') ?? 0,
                'status'      => 1,
            ];

            DB::beginTransaction();
            $question = Question::create($data);
            if ($question) {
                //添加标签
                $tags = $request->get('tags');
                Tag::multiCreate($tags, $question);
                //增加用户对应提问数
                $user->userExtra()->increment('questions_count');
                //增加用户对应天梯分
                Record::records($user, 'ask', (int)Setting::byName('ladder_ask'), (int)Setting::byName('experience_ask'));
            }
            DB::commit();

            return view('question.detail', ['question_id' => $question->id]);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage());
        }
    }

    /**
     * 问题详情
     *
     * @param         $id
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        $question = Question::find($id);
        if (empty($question)) {
            abort(404, '您所访问的问题不存在');
        }
        //问题被查看数+1
        $question->increment('views_count');
        //已采纳回答
        $question->status === 2 ? $adopted = $question->answers()->where('adopted_at', '>', 0)->first() : [];
        $answers = $question->answers()
            ->whereNull('adopted_at')
            ->orderByDesc('created_at')
            ->paginate($this->page_size);

        return view('question.detail', compact('adopted', 'question', 'answers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);

        if (!$question)
            abort(404, '您所访问的问题不存在');

        if ($question->user_id !== Auth::id())
            abort(403, '您没有权限');

        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
