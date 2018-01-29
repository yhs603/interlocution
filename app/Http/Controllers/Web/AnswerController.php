<?php

namespace Interlocution\Http\Controllers\Web;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Interlocution\Models\Answer;
use Interlocution\Models\Question;
use Interlocution\Models\Record;
use Interlocution\Models\Setting;
use Interlocution\Http\Controllers\Controller;
use Interlocution\Models\UserExtra;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            $answer_limit_num_per_hour = (int)Setting::byName('answer_limit_num_per_hour');
            $answer_count              = $this->cacheCounter('answer_num_' . $user->id);
            if ($answer_limit_num_per_hour > 0 && $answer_count > $answer_limit_num_per_hour) {
                throw new \Exception('发布问题过于频繁，请一小时后重试');
            }

            $question_id = $request->get('question_id');
            $question    = Question::find($question_id);

            if (empty($question)) {
                abort(404);
            }

            Validator::make($request->all(), [
                'content' => 'required|min:15|max:65535',
            ]);

            $content = clean($request->input('content'));

            DB::beginTransaction();
            $answer = Answer::create([
                'user_id'        => $user->id,
                'question_id'    => $question_id,
                'question_title' => $question->title,
                'content'        => $content,
                'status'         => 1,
            ]);

            if ($answer) {
                //用户回答数+1
                $user->userExtra()->increment('answers_count');
                //问题回答数+1
                $question->increment('answers_count');
                $this->cacheCounter('answer_num_' . $answer->user_id, 1, 60);
                //增加用户对应天梯分
                Record::records($user, 'answer', (int)Setting::byName('ladder_answer'), (int)Setting::byName('experience_answer'));
            }

            DB::commit();

            return redirect('/question/' . $question_id);
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $answer = Answer::findOrFail($id);

        return view('answer.edit', compact($answer));
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
        $answer = Answer::findOrFail($id);

        Validator::make($request->all(), [
            'content' => 'required|min:15|max:65535',
        ]);

        $answer->content = clean($request->get('content'));
        $answer->status  = 1;
        $answer->save();

        return redirect('/question/' . $answer->question_id);
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

    /**
     * 采纳问题答案
     *
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function adopt($id)
    {
        $answer = Answer::findOrFail($id);
        if (!$answer)
            return abort(404);
        $user = Auth::user();

        if ($answer->adopted_at > 0) {
            return abort(500, '该回答已被采纳');
        }

        try {
            DB::beginTransaction();
            $answer->adopted_at = Carbon::now();
            $answer->save();

            $answer->question()->status = 2;
            $answer->question()->save();

            UserExtra::where('user_id', $answer->user_id)->increment('adoptions_count');
            //增加用户对应天梯分
            Record::records($user, 'adopt', (int)Setting::byName('ladder_adopt'), (int)Setting::byName('experience_adopt'));
            DB::commit();

            return redirect('/question/' . $answer->question_id);
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }
}
