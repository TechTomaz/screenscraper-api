<?php

namespace App\Http\Requests\Api\V2;

/** @see \App\Http\Controllers\Api\V2\BotController::storeRating */
class StoreRatingRequest extends BaseRequest
{
    /** @return array<string, array<string>> */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'ssid' => ['required', 'string'],
            'sspassword' => ['required', 'string'],
            'jeuid' => ['required', 'integer'],
            'note' => ['required', 'integer', 'between:0,20'],
            'region' => ['required', 'string'],
        ]);
    }
}
