<?php

namespace App\Http\Requests\Api;

class SocialAuthorizationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'code' => [
                'required_without:access_token',
                'string',
            ],
            'access_token' => [
                'required_without:code',
                'string',
            ],
        ];

        if ($this->social_type === 'wechat' && ! $this->code) {
            $rules['openid'] = ['required', 'string'];
        }

        return $rules;
    }
}
