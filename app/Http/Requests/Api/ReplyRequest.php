<?php

namespace App\Http\Requests\Api;

class ReplyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:replies,id'],
            'content' => ['required', 'min:2'],
        ];
    }
}
