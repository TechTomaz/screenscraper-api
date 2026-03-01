<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\SearchGamesRequest;
use App\Http\Requests\Api\V2\ShowGameManualRequest;
use App\Http\Requests\Api\V2\ShowGameMediaRequest;
use App\Http\Requests\Api\V2\ShowGameRequest;
use App\Http\Requests\Api\V2\ShowGameVideoRequest;
use Illuminate\Http\JsonResponse;

class GameController
{
    public function search(SearchGamesRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function show(ShowGameRequest $request, int $id): JsonResponse
    {
        return response()->json([]);
    }

    public function media(ShowGameMediaRequest $request, int $id): JsonResponse
    {
        return response()->json([]);
    }

    public function video(ShowGameVideoRequest $request, int $id): JsonResponse
    {
        return response()->json([]);
    }

    public function manual(ShowGameManualRequest $request, int $id): JsonResponse
    {
        return response()->json([]);
    }
}
