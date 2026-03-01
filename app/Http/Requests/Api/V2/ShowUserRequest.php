<?php

namespace App\Http\Requests\Api\V2;

/** @see \App\Http\Controllers\Api\V2\UserController::show */
class ShowUserRequest extends BaseRequest
{
    /** @return array<string, array<string>> */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'ssid' => ['required', 'string'],
            'sspassword' => ['required', 'string'],
        ]);
    }
}
