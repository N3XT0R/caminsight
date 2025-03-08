<?php

namespace App\Filament\Resources\VideosResource\Pages;

use App\Filament\Resources\VideosResource;
use App\Models\Videos;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListVideos extends ListRecords
{
    protected static string $resource = VideosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Hochladen'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Wartend' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('status', Videos::STATUS_WAITING)),
            'In Bearbeitung' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('status', Videos::STATUS_IN_PROGRESS)),
            'Abgeschlossen' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('status', Videos::STATUS_FINISHED)),
        ];
    }
}
