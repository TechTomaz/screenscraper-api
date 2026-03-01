<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\SearchGamesRequest;
use App\Http\Requests\Api\V2\ShowGameManualRequest;
use App\Http\Requests\Api\V2\ShowGameMediaRequest;
use App\Http\Requests\Api\V2\ShowGameRequest;
use App\Http\Requests\Api\V2\ShowGameVideoRequest;
use App\Services\ScreenScraperService;
use Illuminate\Http\JsonResponse;

class GameController
{
    public function __construct(private readonly ScreenScraperService $screenScraper) {}

    public function search(SearchGamesRequest $request): JsonResponse
    {
        return response()->json(
            $this->screenScraper->searchGames(
                searchTerm: $request->recherche,
                systemId: $request->integer('systemeid') ?: null,
            )
        );
    }

    public function show(ShowGameRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->screenScraper->game(
                gameId: $id,
                ssid: $request->ssid,
                sspassword: $request->sspassword,
                systemId: $request->integer('systemeid'),
                romType: $request->romtype,
                romName: $request->romnom,
                romSize: $request->integer('romtaille'),
                crc: $request->crc,
                md5: $request->md5,
                sha1: $request->sha1,
            )
        );
    }

    public function media(ShowGameMediaRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->screenScraper->gameMedia(
                gameId: $id,
                systemId: $request->integer('systemeid'),
                gameName: $request->jeunom,
                mediaName: $request->medianom,
                romName: $request->romnom,
            )
        );
    }

    public function video(ShowGameVideoRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->screenScraper->gameVideo($id, $request->integer('systemeid'), $request->jeunom)
        );
    }

    public function manual(ShowGameManualRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->screenScraper->gameManual($id, $request->integer('systemeid'), $request->jeunom)
        );
    }
}
