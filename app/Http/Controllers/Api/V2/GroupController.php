<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\ShowGroupMediaRequest;
use App\Services\ScreenScraperService;
use Illuminate\Http\JsonResponse;

class GroupController
{
    public function __construct(private readonly ScreenScraperService $screenScraper) {}

    public function media(ShowGroupMediaRequest $request, int $id): JsonResponse
    {
        return response()->json($this->screenScraper->groupMedia($id, $request->medianom));
    }
}
