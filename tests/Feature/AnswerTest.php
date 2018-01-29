<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Interlocution\Models\Answer;
use Interlocution\Models\Question;
use Interlocution\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = User::where('status', 1)->first();
        Auth::login($this->user);
    }

    /** @test */
    public function createNewAnswer()
    {
        $answer  = factory(Answer::class)->create();
        $answers = Answer::orderBy('created_at', 'desc')->get();

        $this->assertEquals($answer->id, $answers->first()->id);
    }

    /** @test */
    public function adoptAnswer()
    {
        $question = Question::where('user_id', $this->user->id)->get()->toArray();
        $answer   = Answer::whereIn('question_id', array_column($question, 'id'))->whereNull('adopted_at')->first();
        $response = $this->get('answer/adopt/' . $answer->id);
        $response->assertStatus(302);
    }

    /** @test */
    public function adoptAnswerWhichHasAdopted()
    {
        $question = Question::where('user_id', $this->user->id)->get()->toArray();
        $answer   = Answer::whereIn('question_id', array_column($question, 'id'))->where('adopted_at', '>', 0)->first();

        if ($answer) {
            $response = $this->get('answer/adopt/' . $answer->id);
            $response->assertStatus(500);
        } else {
            $response = $this->get('answer/adopt/');
            $response->assertStatus(404);
        }
    }
}
