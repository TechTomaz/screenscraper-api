<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\ShowGroupMediaRequest;
use Illuminate\Http\JsonResponse;

class GroupController
{
    public function media(ShowGroupMediaRequest $request, int $id): JsonResponse
    {
        return response()->json([]);
    }
}
