<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JwtLoginTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldAuthenticateUser()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->post(
            '/api/login',
            [
                'email' => $user->email,
                'password' => 'password'
            ]
        );

        $response->assertOk();
    }
}
