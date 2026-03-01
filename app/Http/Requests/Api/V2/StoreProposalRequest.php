<?php

namespace App\Http\Requests\Api\V2;

/** @see \App\Http\Controllers\Api\V2\BotController::storeProposal */
class StoreProposalRequest extends BaseRequest
{
    /** @return array<string, array<string>> */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'ssid' => ['required', 'string'],
            'sspassword' => ['required', 'string'],
            'jeuid' => ['required', 'integer'],
            'type' => ['required', 'string', 'in:infos,media'],
            'champ' => ['required', 'string'],
            'valeur' => ['required', 'string'],
            'region' => ['required', 'string'],
            'langue' => ['required', 'string'],
        ]);
    }
}
