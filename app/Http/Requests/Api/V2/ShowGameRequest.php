<?php

namespace App\Http\Requests\Api\V2;

/** @see \App\Http\Controllers\Api\V2\GameController::show */
class ShowGameRequest extends BaseRequest
{
    /** @return array<string, array<string>> */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'ssid' => ['required', 'string'],
            'sspassword' => ['required', 'string'],
            'systemeid' => ['required', 'integer'],
            'romtype' => ['required', 'string', 'in:rom,iso,disc,scummvm,exodos'],
            'romnom' => ['required', 'string'],
            'romtaille' => ['required', 'integer', 'min:0'],
            'crc' => ['sometimes', 'string', 'size:8'],
            'md5' => ['sometimes', 'string', 'size:32'],
            'sha1' => ['sometimes', 'string', 'size:40'],
        ]);
    }
}
