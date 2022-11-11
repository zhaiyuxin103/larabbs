<?php

namespace App\Http\Requests\Api;

class VerificationCodeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'captcha_key' => ['required', 'string'],
            'captcha_code' => ['required', 'string'],
        ];
    }
}
