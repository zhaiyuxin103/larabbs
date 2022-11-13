<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = ['type', 'path'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
