<?php

namespace App\Console\Commands;

use App\Filament\Resources\VideosResource;
use App\Models\Action;
use App\Models\VideoBatch;
use App\Models\Videos;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractVideoBatchCommand extends Command
{


    abstract protected function handleVideo(Videos $video): int;


    public function handle(): int
    {
        $videos = $this->getVideosToProcessing();
        $exitCode = self::SUCCESS;

        foreach ($videos as $video) {
            $video->setAttribute('status', Videos::STATUS_IN_PROGRESS);
            $video->save();
            $batch = new VideoBatch();
            $batch->setAttribute('video_id', $video->getKey());
            $batch->setAttribute('is_running', true);
            $batch->setAttribute('action_id', $this->getCurrentActionId());
            $batch->save();
            $exitCode = $this->handleVideo($video);
            $batch->setAttribute('is_running', false);
            $batch->setAttribute('is_done', 0 === $exitCode);
            $batch->save();
        }

        return $exitCode;
    }


    /**
     * @return Collection|Videos[]
     */
    protected function getVideosToProcessing(): Collection
    {
        $videos = VideosResource::getEloquentQuery()
            ->leftJoin('video_batch', 'video.id', 'video_batch.video_id')
            ->whereNot('video_batch.action_id', $this->getCurrentActionId())
            ->get();

        return $videos;
    }

    protected function getCurrentActionId(): int
    {
        return Action::query()
            ->where('video_command', $this->signature)
            ->firstOrFail()
            ->getKey();
    }
}