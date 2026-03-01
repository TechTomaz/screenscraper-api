<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\StoreProposalRequest;
use App\Http\Requests\Api\V2\StoreRatingRequest;
use Illuminate\Http\JsonResponse;

class BotController
{
    public function storeRating(StoreRatingRequest $request): JsonResponse
    {
        return response()->json([]);
    }

    public function storeProposal(StoreProposalRequest $request): JsonResponse
    {
        return response()->json([]);
    }
}
