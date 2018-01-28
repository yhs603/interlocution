<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /** @test */
    public function welcome()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function home()
    {
        $response = $this->get('/home');
        if (Auth::user())
            $response->assertStatus(200);
        $response->assertStatus(302);
    }
}
