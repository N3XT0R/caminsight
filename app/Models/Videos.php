<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $table = 'video';

    public const STATUS_WAITING = 'WAITING';

    public const STATUS_IN_PROGRESS = 'IN_PROGRESS';

    public const STATUS_FINISHED = 'FINISHED';
}
