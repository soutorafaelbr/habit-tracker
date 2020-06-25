<?php


namespace App\Actions\Auth;


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
        $attempt = $this->attempt($authenticationData);

        if (! $attempt) {
            throw new UnauthorizedHttpException("Invalid Credentials");
        }

        return $attempt;
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
