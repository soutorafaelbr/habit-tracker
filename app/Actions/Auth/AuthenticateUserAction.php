<?php


namespace App\Actions\Auth;


use App\DataTransferObjects\AuthenticatedData;
use App\JWT;
use Illuminate\Contracts\Auth\Guard as Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthenticateUserAction
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function execute($authenticationData)
    {
        $token = $this->attempt($authenticationData);

        if (! $token) {
            throw new UnauthorizedHttpException("Invalid Credentials");
        }

        return (new AuthenticatedData())
            ->setToken($token)
            ->setTokenType(JWT::TYPE)
            ->setExpiresIn(JWT::EXPIRATION);
    }

    private function attempt($authenticationData)
    {
        return $this
            ->auth
            ->attempt(
                [
                    'email' => $authenticationData['email'],
                    'password' => $authenticationData['password']
                ]
            );
    }
}
