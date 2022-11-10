<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class Link extends Model
{
    protected $fillable = ['title', 'description', 'link', 'show', 'order'];

    public string $cache_key = 'larabbs_links';

    protected int|float $cache_expire_in_seconds = 1440 * 60;

    public function getAllCached()
    {
        // 尝试从缓存中取出 cache_key 对应的数据，如果能找到，便直接返回数据
        // 否则运行匿名函数中的代码来取出 links 表中所有的数据，返回的同时做了缓存
        return Cache::remember($this->cache_key, $this->cache_expire_in_seconds, function () {
            return $this->where('show', true)->limit(6)->get();
        });
    }
}
