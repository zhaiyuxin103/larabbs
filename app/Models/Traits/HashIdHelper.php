<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Vinkla\Hashids\Facades\Hashids;

trait HashIdHelper
{
    private string $hashId;

    // 调用 $model->hash_id 时触发
    public function hashId(): Attribute
    {
        return Attribute::make(
            get: fn () => Hashids::encode($this->id),
        );
    }

    // 先将参数 decode 为模型 id，再调用父类的 resolveRouteBinding 方法
    public function resolveRouteBinding($value, $field = null)
    {
        $value = current(Hashids::decode($value));
        if (! $value) {
            return;
        }

        return parent::resolveRouteBinding($value);
    }
}
