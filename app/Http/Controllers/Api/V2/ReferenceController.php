<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\BaseRequest;
use App\Services\ScreenScraperService;
use Illuminate\Http\JsonResponse;

class ReferenceController
{
    public function __construct(private readonly ScreenScraperService $screenScraper) {}

    public function regions(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->regions());
    }

    public function languages(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->languages());
    }

    public function genres(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->genres());
    }

    public function families(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->families());
    }

    public function classifications(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->classifications());
    }

    public function romTypes(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->romTypes());
    }

    public function supportTypes(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->supportTypes());
    }

    public function playerCounts(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->playerCounts());
    }
}
