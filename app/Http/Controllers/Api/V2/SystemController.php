<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\BaseRequest;
use App\Http\Requests\Api\V2\ShowSystemMediaRequest;
use App\Services\ScreenScraperService;
use Illuminate\Http\JsonResponse;

class SystemController
{
    public function __construct(private readonly ScreenScraperService $screenScraper) {}

    public function index(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->systems());
    }

    public function mediaTypes(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->systemMediaTypes());
    }

    public function media(ShowSystemMediaRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->screenScraper->systemMedia($id, $request->medianom, $request->mediaid)
        );
    }

    public function video(BaseRequest $request, int $id): JsonResponse
    {
        return response()->json($this->screenScraper->systemVideo($id));
    }
}
