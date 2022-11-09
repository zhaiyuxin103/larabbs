<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'subtitle', 'image', 'body', 'user_id', 'category_id', 'is_released', 'need_released', 'released_at', 'vote_count', 'collect_count', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }
    }

    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，将编写逻辑来更新话题模型的 reply_count 属性
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->latest('updated_at');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->latest();
    }

    public function lastReplyUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function link($params = []): string
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }
}
