<?php

namespace App\Models;

use Awssat\Visits\Visits;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Topic extends Model
{
    use SoftDeletes;
    use Traits\HashIdHelper;

    protected $fillable = ['title', 'subtitle', 'image', 'body', 'user_id', 'category_id', 'is_released', 'need_released', 'released_at', 'vote_count', 'collect_count', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'image_link',
        'visits_count',
        'hash_id',
    ];

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
        return route('topics.show', array_merge([$this->hash_id, $this->slug], $params));
    }

    public function updateReplyCount()
    {
        $this->last_reply_user_id = $this->replies()->where('show', true)->get()->last()->user_id ?? 0;
        $this->reply_count = $this->replies()->where('show', true)->count();
        $this->save();
    }

    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? Storage::url($this->image) : null,
        );
    }

    public function visits(): Visits
    {
        return visits($this);
    }

    public function visitsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->visits()->count(),
        );
    }
}
