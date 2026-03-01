<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\BaseRequest;
use Illuminate\Http\JsonResponse;

class ReferenceController
{
    public function regions(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function languages(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function genres(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function families(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function classifications(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function romTypes(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function supportTypes(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function playerCounts(BaseRequest $request): JsonResponse
    {
        return response()->json([]);
    }
}
