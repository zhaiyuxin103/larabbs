<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class CaptchaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'output' => [
                'required',
                Rule::in(['base64', 'link']),
            ],
            'phone' => [
                'required',
                'phone:CN,mobile',
                Rule::unique('users')->where(function ($query) {
                    $query->where('deleted_at', null);
                }),
            ],
        ];
    }
}
