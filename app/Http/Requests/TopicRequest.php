<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST', 'PUT', 'PATCH' => [
                'title' => ['required', 'min:2', 'max:50'],
                'subtitle' => ['required', 'min:3', 'max:50'],
                'image' => ['required'],
                'parent_id' => ['required', 'numeric'],
                'category_id' => ['required', 'numeric'],
                'body' => ['required', 'min:3'],
                'is_released' => [],
                'released_at' => [],
            ],
            default => [],
        };
    }

    public function messages(): array
    {
        return [
            'title.min' => '标题必须至少两个字符',
            'body.min' => '文章内容必须至少三个字符',
        ];
    }
}
