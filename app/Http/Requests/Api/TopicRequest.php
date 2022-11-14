<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

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
            'POST' => [
                'title' => ['required', 'string'],
                'subtitle' => ['required', 'string'],
                'topic_image_id' => ['required', 'exists:images,id'],
                'body' => ['required', 'string'],
                'category_id' => [
                    'required',
                    Rule::exists('categories', 'id')->where(function ($query) {
                        return $query->whereNotNull('parent_id')->where('is_directory', false)->where('level', 1)->where('show', true);
                    }),
                ],
                'is_released' => ['boolean'],
                'need_released' => ['boolean'],
                'released_at' => ['nullable', 'date_format:Y-m-d H:i:s'],
                'order' => ['nullable', 'integer'],
            ],
            'PATCH' => [
                'title' => ['string'],
                'subtitle' => ['string'],
                'topic_image_id' => ['exists:images,id'],
                'body' => ['string'],
                'category_id' => [
                    Rule::exists('categories', 'id')->where(function ($query) {
                        return $query->whereNotNull('parent_id')->where('is_directory', false)->where('level', 1)->where('show', true);
                    }
            ),
                ],
                'is_released' => ['boolean'],
                'need_released' => ['boolean'],
                'released_at' => ['nullable', 'date_format:Y-m-d H:i:s'],
                'order' => ['nullable', 'integer'],
            ]
        };
    }
}
