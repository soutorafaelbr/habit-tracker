<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Responses\CreatedResponse;
use App\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        $user = (new User())
            ->fill($request->validated())
            ->save();

        return new CreatedResponse($user);
    }
}
