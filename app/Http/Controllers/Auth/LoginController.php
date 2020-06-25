<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\AuthenticateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Responses\UnauthorizedResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LoginController extends Controller
{
    private AuthenticateUserAction $authenticateUserAction;

    public function __construct(AuthenticateUserAction $authenticateUserAction)
    {
        $this->authenticateUserAction = $authenticateUserAction;
    }

    public function __invoke(AuthenticateUserRequest $request): JsonResponse
    {
        try {

            $token = $this
                ->authenticateUserAction
                ->execute($request->validated());

            return $this->respondWithToken($token);
        } catch (UnauthorizedHttpException $exception) {

            return new UnauthorizedResponse();
        }
    }

    private function unauthorizedResponse(): JsonResponse
    {
        return new JsonResponse(
            [
                'error' => 'Session unauthorized'
            ],
            401
        );
    }

    protected function respondWithToken(string $token): JsonResponse
    {
        return new JsonResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
