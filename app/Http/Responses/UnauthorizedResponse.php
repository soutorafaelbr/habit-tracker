<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class UnauthorizedResponse extends JsonResponse
{
    private int $code = 401;

    private string $message = 'Unauthorized credentials for the target resource';

    public function __construct()
    {
        parent::__construct(
            [
                'error' => $this->message,
            ],
            $this->code
        );
    }
}
