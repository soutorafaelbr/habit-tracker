<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $token = $this
            ->auth
            ->attempt(
                [
                    'email' => $request->get('email'),
                    'password' => $request->get('password')
                ]
            );

        if (! $token) {
            return $this->unauthorizedResponse();
        }

        return $this->respondWithToken($token);
    }

    private function unauthorizedResponse()
    {
        return new JsonResponse(
            [
                'error' => 'Session unauthorized'
            ],
            401
        );
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
