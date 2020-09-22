<?php

namespace Tests\Feature\Goals;

use App\Goal;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class GoalTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldListGoals()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $goals = factory(Goal::class, 5)->create(
            [
                'user_id' => $user->id,
            ]
        );

        $token = JWTAuth::fromUser($user);

        $response = $this->get(
            '/api/goals',
            [
                'Authorization' => "Bearer $token",
                'accept' => 'application/json',
            ]
        );

        $response->assertOk();
    }
}
