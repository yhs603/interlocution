<?php

namespace Tests\Feature;

use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use Interlocution\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /** @test */
    public function emailVerifyWithIncorrectToken()
    {
        $response = $this->get('/email/verify/' . Uuid::uuid1()->toString());
        $response->assertStatus(403);
    }

    /** @test */
    public function emailVerifyWithCorrectToken()
    {
        $user     = User::where('status', 0)->first();
        $response = $this->get('/email/verify/' . $user->confirmation_token);

        if ($user) {
            $response->assertStatus(302);
        } else {
            $response->assertStatus(403);
        }
    }
}
