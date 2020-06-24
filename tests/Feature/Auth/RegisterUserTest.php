<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            array_merge($user, ['password' => 123456])
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
}
