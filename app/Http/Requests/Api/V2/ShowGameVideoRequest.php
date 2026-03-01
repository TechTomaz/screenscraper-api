<?php

namespace App\Http\Requests\Api\V2;

/** @see \App\Http\Controllers\Api\V2\GameController::video */
class ShowGameVideoRequest extends BaseRequest
{
    /** @return array<string, array<string>> */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'systemeid' => ['required', 'integer'],
            'jeunom' => ['required', 'string'],
        ]);
    }
}
