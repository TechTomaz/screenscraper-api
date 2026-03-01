<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\BaseRequest;
use App\Http\Requests\Api\V2\ShowUserRequest;
use App\Services\ScreenScraperService;
use Illuminate\Http\JsonResponse;

class UserController
{
    public function __construct(private readonly ScreenScraperService $screenScraper) {}

    public function show(ShowUserRequest $request): JsonResponse
    {
        return response()->json(
            $this->screenScraper->user($request->ssid, $request->sspassword)
        );
    }

    public function levels(BaseRequest $request): JsonResponse
    {
        return response()->json($this->screenScraper->userLevels());
    }
}
