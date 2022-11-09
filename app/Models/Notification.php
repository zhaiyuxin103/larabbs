<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use Traits\HasDateTimeFormatter;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
