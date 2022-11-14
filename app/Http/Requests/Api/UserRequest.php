<?php

namespace App\Http\Requests\Api;

use Illuminate\Support\Facades\Auth;
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
        $userId = Auth::guard('api')->id();

        return match ($this->method()) {
            'POST' => [
                'name' => [
                    'required',
                    'between:3,25',
                    'regex:/[\w\x{4e00}-\x{9fa5}]{2,25}/u',
                ],
                'username' => [
                    'required',
                    'regex:/^[A-Za-z0-9\-\_]+$/',
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('users')->where(function ($query) {
                        $query->whereNull('deleted_at');
                    }),
                ],
                'avatar_image_id' => ['nullable', 'exists:images,id'],
                'gender' => ['nullable', 'integer'],
                'birthday' => ['nullable', 'date'],
                'password' => ['required', 'alpha_dash', 'min:6'],
                'introduction' => ['max:80'],
                'verification_key' => ['required', 'string'],
                'verification_code' => ['required', 'string'],
            ],
            'PATCH' => [
                'name' => [
                    'nullable',
                    'between:3,25',
                    'regex:/[\w\x{4e00}-\x{9fa5}]{2,25}/u',
                ],
                'username' => [
                    'nullable',
                    'regex:/^[A-Za-z0-9\-\_]+$/',
                    'max:255',
                    Rule::unique('users')->where(function ($query) use ($userId) {
                        $query->where('id', '<>', $userId)->whereNull('deleted_at');
                    }),
                ],
                'phone' => [
                    'nullable',
                    'phone:CN,mobile',
                    Rule::unique('users')->where(function ($query) use ($userId) {
                        $query->where('id', '<>', $userId)->whereNull('deleted_at');
                    }),
                ],
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('users')->where(function ($query) use ($userId) {
                        $query->where('id', '<>', $userId)->whereNull('deleted_at');
                    }
            ),
                ],
                'avatar_image_id' => ['nullable', 'exists:images,id,type,avatar,user_id,'.$userId],
                'gender' => ['nullable', 'integer'],
                'birthday' => ['nullable', 'date'],
                'introduction' => ['max:80'],
            ]
        };
    }
}
