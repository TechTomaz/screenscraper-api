<?php

namespace App\Http\Requests\Api\V2;

/** @see \App\Http\Controllers\Api\V2\CompanyController::media */
class ShowCompanyMediaRequest extends BaseRequest
{
    /** @return array<string, array<string>> */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'medianom' => ['required', 'string'],
        ]);
    }
}
