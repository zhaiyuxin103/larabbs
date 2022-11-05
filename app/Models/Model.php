<?php

namespace App\Models;

use App\Scopes\OrderScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use HasFactory;
    use Traits\HasDateTimeFormatter;

    /**
     * 模型的「引导」方法。
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new OrderScope());
    }
}
