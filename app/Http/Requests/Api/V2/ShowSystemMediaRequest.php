<?php

namespace App\Http\Requests\Api\V2;

/** @see \App\Http\Controllers\Api\V2\SystemController::media */
class ShowSystemMediaRequest extends BaseRequest
{
    /** @return array<string, array<string>> */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'medianom' => ['required', 'string'],
            'mediaid' => ['sometimes', 'string'],
        ]);
    }
}
