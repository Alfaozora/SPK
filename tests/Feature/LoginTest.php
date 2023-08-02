<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function test_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /** @test */
    public function test_proses()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
