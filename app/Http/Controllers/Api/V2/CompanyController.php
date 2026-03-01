<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\Api\V2\ShowCompanyMediaRequest;
use Illuminate\Http\JsonResponse;

class CompanyController
{
    public function media(ShowCompanyMediaRequest $request, int $id): JsonResponse
    {
        return response()->json([]);
    }
}
