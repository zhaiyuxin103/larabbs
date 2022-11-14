<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use JsonSerializable;

class UserResource extends JsonResource
{
    protected bool $showSensitiveFields = false;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        if (! $this->showSensitiveFields) {
            $this->resource->phone = Str::mask($this->resource->phone, '*', -8, 4);
            $this->resource->makeHidden(['email']);
        }

        $data = parent::toArray($request);

        $data['bound_phone'] = (bool) $this->resource->phone;
        $data['bound_wechat'] = $this->resource->weixin_unionid || $this->resource->weixin_openid;
        $data['roles'] = RoleResource::collection($this->whenLoaded('roles'));

        return $data;
    }

    /**
     * @return $this
     */
    public function showSensitiveFields(): static
    {
        $this->showSensitiveFields = true;

        return $this;
    }
}
