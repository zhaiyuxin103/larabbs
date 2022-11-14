<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'image' => $this->image,
            'image_link' => $this->image_link,
            'body' => $this->body,
            'user_id' => $this->user_id,
            'category_id' => (int) $this->category_id,
            'is_released' => (int) $this->is_released,
            'need_released' => (int) $this->need_released,
            'released_at' => $this->released_at,
            'vote_count' => (int) $this->vote_count,
            'collect_count' => (int) $this->collect_count,
            'reply_count' => (int) $this->reply_count,
            'view_count' => (int) $this->view_count,
            'last_reply_user_id' => (int) $this->last_reply_user_id,
            'excerpt' => $this->excerpt,
            'slug' => $this->slug,
            'order' => $this->order,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
