<?php

namespace App\Http\Requests;

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
            'content' => ['required', 'min:2'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => '内容不能为空',
            'content.min' => '内容必须至少两个字符',
        ];
    }
}
