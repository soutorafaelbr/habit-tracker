<?php
namespace App\DataTransferObjects;

class AuthenticatedData
{
    private string $token;

    private string $tokenType;

    private int $expiresIn;

    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }

    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
