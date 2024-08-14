<?php

namespace App\Http\Requests\AmoCRM\Api;

use Illuminate\Foundation\Http\FormRequest;

class GetLeadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'domain' => ['required', 'string'],
        ];
    }
}
