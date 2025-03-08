<?php

namespace App\Filament\Resources\VideosResource\Pages;

use App\Filament\Resources\VideosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVideos extends CreateRecord
{
    protected static string $resource = VideosResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
