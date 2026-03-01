<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\BaseRequest;
use App\Services\ScreenScraperService;
use Illuminate\Http\JsonResponse;

class InfrastructureController
{
    public function __construct(private readonly ScreenScraperService $screenScraper) {}

    public function show(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->infrastructure());
    }
}
