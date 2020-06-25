<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
            ],
            [
                'accept' => 'application/json'
            ]
        );

        $response->assertOk();

        $this->assertAuthenticated();
    }

    public function testShouldReturnUnauthorizedToWrongCredentials()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->post(
            '/api/login',
            [
                'email' => 'email@email.org',
                'password' => 'password'
            ],
            [
                'accept' => 'application/json'
            ]
        );

        $response->assertUnauthorized();
    }

    public function testShouldValidateEmail()
    {
        $user = factory(User::class)->create();

        $response = $this->post(
            '/api/login',
            [
                'email' => '',
                'password' => 'password'
            ],
            [
                'accept' => 'application/json'
            ]
        );

        $response->assertJsonValidationErrors('email');
        $response->assertStatus(422);
    }
}
