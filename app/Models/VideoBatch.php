<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoBatch extends Model
{
    protected $table = 'video_batch';

    protected $fillable = [
        'video_id',
        'action_id',
        'is_done',
        'is_running',
        'data'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Videos::class);
    }

    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }
}