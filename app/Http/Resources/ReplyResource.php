<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ReplyResource extends JsonResource
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
            'id' => $this->resource->id,
            'topic_id' => $this->resource->topic_id,
            'user_id' => $this->resource->user_id,
            'parent_id' => (int) $this->resource->parent_id,
            'content' => $this->resource->content,
            'show' => (int) $this->resource->show,
            'order' => (int) $this->resource->order,
            'created_at' => (string) $this->resource->created_at,
            'updated_at' => (string) $this->resource->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'topic' => new TopicResource($this->whenLoaded('topic')),
            'children' => ReplyResource::collection($this->whenLoaded('children')),
        ];
    }
}
