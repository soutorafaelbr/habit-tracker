<?php

namespace App\Http\Controllers;

use App\Goal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'data' => $request->user()->goals,
            ],
            200
        );
    }
}
