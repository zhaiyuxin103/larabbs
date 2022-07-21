<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'is_directory', 'level', 'path'];

    protected $casts = [
        'is_directory' => 'boolean',
        'show' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__);
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    // 定义一个访问器，获取所有祖先类目的 ID 值
    protected function pathIds(): Attribute
    {
        return Attribute::make(
            // trim($string, '-') 将字符串两端的 - 符号去除
            // explode() 将字符串以 - 为分隔切割为数组
            // 最后 array_filter 将数组中的空值去除
            get: fn ($value) => array_filter(explode('-', trim($this->path, '-'))),
        );
    }

    // 定义一个访问器，获取所有祖先类目并按层级排序
    protected function ancestors(): Attribute
    {
        return Attribute::make(
            // 使用上面的访问器获取所有祖先类目 ID
            // 按层级排序
            get: fn ($value) => Category::query()->where('id', $this->path_ids)->orderBy('level')->get(),
        );
    }

    // 定义一个访问器，获取以 - 为分隔的所有祖先类目名称以及当前类目的名称
    protected function fullName(): Attribute
    {
        return Attribute::make(
            // 获取所有祖先类目
            // 取出所有祖先类目的 name 字段作为一个数组
            // 将当前类目的 name 字段值加到数组的末尾
            // 用 - 符号将数组的值组装成一个字符串
            get: fn ($value) => $this->ancestors->pluck('name')->push($this->name)->implode(' - '),
        );
    }
}
