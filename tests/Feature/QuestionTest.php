<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Interlocution\Models\Question;
use Interlocution\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTest extends TestCase
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
    public function index()
    {
        $response = $this->get('/question');
        $response->assertStatus(200);
    }

    /** @test */
    public function createNewQuestion()
    {
        $question  = factory(Question::class)->create();
        $questions = Question::orderBy('created_at', 'desc')->get();

        $this->assertEquals($question->id, $questions->first()->id);
    }

    /** @test */
    public function showQuestionDetail()
    {
        $id       = random_int(0, Question::count());
        $response = $this->get('question/' . $id);
        if ($id == 0)
            $response->assertStatus(404);
        else
            $response->assertStatus(200);
    }

    /** @test */
    public function editQuestionWhichIsNotBelongToYourself()
    {
        $question = Question::where('user_id', '<>', $this->user->id)->first();
        $response = $this->get('question/' . $question->id . '/edit');
        $response->assertStatus(403);
    }

    /** @test */
    public function editQuestionWhichIsNotExist()
    {
        $response = $this->get('question/0/edit');
        $response->assertStatus(404);
    }

    /** @test */
    public function editQuestionWhichIsExist()
    {
        $question = Question::where('status', 1)->where('user_id', $this->user->id)->orderBy('id', 'desc')->first();
        if ($question) {
            $response = $this->get('question/' . $question->id . '/edit');
            $response->assertStatus(200);
        }else{
            $response = $this->get('question/0/edit');
            $response->assertStatus(404);
        }
    }
}
