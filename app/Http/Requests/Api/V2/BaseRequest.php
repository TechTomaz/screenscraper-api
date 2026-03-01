<?php

namespace App\Http\Requests\Api\V2;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, array<string>> */
    public function rules(): array
    {
        return [
            'devid' => ['required', 'string'],
            'devpassword' => ['required', 'string'],
            'softname' => ['required', 'string'],
            'output' => ['required', 'string', 'in:xml,json,ini'],
        ];
    }
}
