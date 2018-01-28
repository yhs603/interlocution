<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Interlocution\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityTest extends TestCase
{
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = User::where('status', 1)->first();
        Auth::login($this->user);
    }

    /** @test */
    public function ajaxGetProvinceList()
    {
        $response = $this->json('get', 'city/province');

        $response->assertStatus(200)
            ->assertJson([
                'code' => '200'
            ]);
    }

    /** @test */
    public function ajaxGetCityList()
    {
        $response = $this->json('get', 'city/city/510000');

        $response->assertStatus(200)
            ->assertJson([
                'code' => '200'
            ]);
    }

    /** @test */
    public function ajaxGetDistrictList()
    {
        $response = $this->json('get', 'city/district/110000');

        $response->assertStatus(200)
            ->assertJson([
                'code' => '200'
            ]);
    }
}
