<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'subtitle', 'image', 'body', 'user_id', 'category_id', 'is_released', 'need_released', 'released_at', 'vote_count', 'collect_count', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];
}
