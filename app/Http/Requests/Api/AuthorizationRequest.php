<?php

namespace App\Http\Requests\Api;

class AuthorizationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'alpha_dash', 'min:6'],
        ];
    }
}
