<?php

namespace Tests\Feature;

use Interlocution\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /** @test */
    public function emailVerifyWithIncorrectToken()
    {
        $response = $this->get(route('email.verify', ['token' => Uuid::uuid1()->toString()]));
        $response->assertStatus(403);
    }

    /** @test */
    public function emailVerifyWithCorrectToken()
    {
        $user = User::where('status', 0)->first();

        if ($user) {
            $response = $this->get(route('email.verify', ['token' => $user->confirmation_token]));
            $response->assertStatus(200);
        }

        $response->asser(403);
    }
}
