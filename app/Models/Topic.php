<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends Model
{
    protected $fillable = ['title', 'subtitle', 'image', 'body', 'user_id', 'category_id', 'is_released', 'need_released', 'released_at', 'vote_count', 'collect_count', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
