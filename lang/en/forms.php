<?php

use App\Models\Videos;

return [
    'video' => [
        'video_file' => 'Video-File',
        'comment' => 'Comment',
        'messages' => [
            'uploaded' => [
                'title' => 'Video uploaded',
                'body' => 'Video was successfully uploaded',
            ],
        ],
        'type' => 'Type',
        'status' => [
            Videos::STATUS_WAITING => 'Waiting',
            Videos::STATUS_IN_PROGRESS => 'In Progress',
            Videos::STATUS_FINISHED => 'Finished',
        ],
    ],
];