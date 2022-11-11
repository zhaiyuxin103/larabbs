<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class UserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'between:3,25',
                'regex:/[\w\x{4e00}-\x{9fa5}]{2,25}/u',
                Rule::unique('users')->where(function ($query) {
                    $query->where('deleted_at', null);
                }),
            ],
            'password' => [
                'required',
                'alpha_dash',
                'min:6',
            ],
            'verification_key' => [
                'required',
                'string',
            ],
            'verification_code' => [
                'required',
                'string',
            ],
        ];
    }
}
