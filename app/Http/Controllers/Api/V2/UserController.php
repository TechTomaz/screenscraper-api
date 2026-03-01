<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\BaseRequest;
use App\Http\Requests\Api\V2\ShowUserRequest;
use Illuminate\Http\JsonResponse;

class UserController
{
    public function show(ShowUserRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function levels(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }
}
