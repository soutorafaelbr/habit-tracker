<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldRegisterAUser()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)
            ->make()
            ->toArray();

        $response = $this->post(
            '/api/register',
            array_merge($user, ['password' => 123456]),
            [
                'accept' => 'application/json',
            ]
        );

        $response->assertCreated();

        $this->assertDatabaseHas(
            'users',
            [
                'name' => $user['name'],
                'email' => $user['email'],
                'nickname' => $user['nickname'],
                'occupation' => $user['occupation'],
            ]
        );
    }

    public function testShouldValidateName()
    {
        $user = factory(User::class)
            ->make(['name' => ''])
            ->toArray();

        $response = $this->post(
            '/api/register',
            array_merge($user, ['password' => 123456]),
            [
                'accept' => 'application/json',
            ]
        );

        $response->assertJsonValidationErrors('name');
        $response->assertStatus(422);
    }

    public function testShouldValidateEmail()
    {
        $user = factory(User::class)
            ->make(['email' => ''])
            ->toArray();

        $response = $this->post(
            '/api/register',
            array_merge($user, ['password' => 123456]),
            [
                'accept' => 'application/json',
            ]
        );

        $response->assertJsonValidationErrors('email');
        $response->assertStatus(422);
    }

    public function testShouldValidateNickname()
    {
        $user = factory(User::class)
            ->make(['nickname' => ''])
            ->toArray();

        $response = $this->post(
            '/api/register',
            array_merge($user, ['password' => 123456]),
            [
                'accept' => 'application/json',
            ]
        );

        $response->assertJsonValidationErrors('nickname');
        $response->assertStatus(422);
    }

    public function testShouldValidateOccupation()
    {
        $user = factory(User::class)
            ->make(['occupation' => ''])
            ->toArray();

        $response = $this->post(
            '/api/register',
            array_merge($user, ['password' => 123456]),
            [
                'accept' => 'application/json',
            ]
        );

        $response->assertJsonValidationErrors('occupation');
        $response->assertStatus(422);
    }

    public function testShouldValidatePassword()
    {
        $user = factory(User::class)
            ->make()
            ->toArray();

        $response = $this->post(
            '/api/register',
            $user,
            [
                'accept' => 'application/json',
            ]
        );

        $response->assertJsonValidationErrors('password');
        $response->assertStatus(422);
    }
}
