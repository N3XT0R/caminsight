<?php

use App\Models\Videos;

return [
    'video' => [
        'video_file' => 'Video-Datei',
        'comment' => 'Kommentar',
        'messages' => [
            'uploaded' => [
                'title' => 'Video wurde erstellt',
                'body' => 'Das Video wurde erfolgreich hochgeladen',
            ],
        ],
        'type' => 'Typ',
        'status' => [
            Videos::STATUS_WAITING => 'Wartend',
            Videos::STATUS_IN_PROGRESS => 'In Bearbeitung',
            Videos::STATUS_FINISHED => 'Abgeschlossen',
        ],
    ],
];