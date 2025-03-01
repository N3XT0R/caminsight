<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Videos extends Model
{
    protected $table = 'video';

    public const STATUS_WAITING = 'WAITING';

    public const STATUS_IN_PROGRESS = 'IN_PROGRESS';

    public const STATUS_FINISHED = 'FINISHED';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
