<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = new User();

        $user->fill(
            [
                'name' => $request->get('name'),
                'nickname' => $request->get('nickname'),
                'occupation' => $request->get('occupation'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]
        );

        $user->save();

        return new JsonResponse(
            [
               'data' => $user,
            ],
            201
        );
    }
}
