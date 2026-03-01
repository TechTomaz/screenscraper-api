<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\BaseRequest;
use Illuminate\Http\JsonResponse;

class InfrastructureController
{
    public function show(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }
}
