<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\StoreProposalRequest;
use App\Http\Requests\Api\V2\StoreRatingRequest;
use App\Services\ScreenScraperService;
use Illuminate\Http\JsonResponse;

class BotController
{
    public function __construct(private readonly ScreenScraperService $screenScraper) {}

    public function storeRating(StoreRatingRequest $request): JsonResponse
    {
        return response()->json(
            $this->screenScraper->storeRating(
                ssid: $request->ssid,
                sspassword: $request->sspassword,
                gameId: $request->integer('jeuid'),
                rating: $request->integer('note'),
                region: $request->region,
            )
        );
    }

    public function storeProposal(StoreProposalRequest $request): JsonResponse
    {
        return response()->json(
            $this->screenScraper->storeProposal(
                ssid: $request->ssid,
                sspassword: $request->sspassword,
                gameId: $request->integer('jeuid'),
                type: $request->type,
                field: $request->champ,
                value: $request->valeur,
                region: $request->region,
                language: $request->langue,
            )
        );
    }
}
