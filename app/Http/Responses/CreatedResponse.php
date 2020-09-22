<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class CreatedResponse extends JsonResponse
{
    private int $code = 201;

    private string $message = 'Resource created successfully.';

    public function __construct($data = [])
    {
        parent::__construct(
            [
                'message' => $this->message,
                'data' => $data,
            ],
            $this->code
        );
    }
}
