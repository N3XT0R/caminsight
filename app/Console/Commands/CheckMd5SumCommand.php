<?php

namespace App\Console\Commands;

use App\Filament\Resources\VideosResource;
use App\Models\Videos;
use Illuminate\Console\Command;

class CheckMd5SumCommand extends AbstractVideoBatchCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-video-md5';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks that videos by hashsum are not duplicated';


    /**
     * Execute the console command.
     */
    public function handleVideo(Videos $video): int
    {
        $isDuplicated = VideosResource::getEloquentQuery()
                ->where('hash_sum',
                    $video->getAttribute('hash_sum'))
                ->count() > 1;

        $video->setAttribute('is_duplicated', $isDuplicated);
        if (true === $isDuplicated) {
        }
        return $video->save() ? self::SUCCESS : self::FAILURE;
    }
}