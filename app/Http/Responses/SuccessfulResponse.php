<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class SuccessfulResponse extends JsonResponse
{
    private int $code = 200;

    private string $message = '';

    public function __construct($data = [])
    {
        parent::__construct(
            [
                'data' => $data,
            ],
            $this->code
        );
    }
}
