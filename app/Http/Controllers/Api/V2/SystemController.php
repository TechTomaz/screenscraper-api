<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\BaseRequest;
use App\Http\Requests\Api\V2\ShowSystemMediaRequest;
use Illuminate\Http\JsonResponse;

class SystemController
{
    public function index(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function mediaTypes(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function media(ShowSystemMediaRequest $request, int $id): JsonResponse
    {
        return response()->json([]);
    }

    public function video(BaseRequest $request, int $id): JsonResponse
    {
        return response()->json([]);
    }
}
