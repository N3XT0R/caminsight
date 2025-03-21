<?php

namespace App\Console\Commands;

use App\Filament\Resources\VideosResource;
use App\Models\Videos;
use App\Services\Google\VideoIntelligence\Contracts\ClientContract;
use Illuminate\Console\Command;

class RecognizeVideosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recognize-videos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ClientContract $client): int
    {
        $videos = VideosResource::getEloquentQuery()
            ->where('status', Videos::STATUS_WAITING)
            ->get();

        foreach ($videos as $video) {
        }

        return self::SUCCESS;
    }
}
