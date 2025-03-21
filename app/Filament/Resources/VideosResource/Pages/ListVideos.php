<?php

namespace App\Filament\Resources\VideosResource\Pages;

use App\Filament\Resources\VideosResource;
use App\Models\Videos;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

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
        return Arr::collapse([
            $this->getTab(Videos::STATUS_WAITING),
            $this->getTab(Videos::STATUS_IN_PROGRESS),
            $this->getTab(Videos::STATUS_FINISHED),
            $this->getTab(Videos::STATUS_DUPLICATED),
        ]);
    }

    protected function getTab(string $status): array
    {
        return [
            __('forms.video.status.'.$status) => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', $status))
        ];
    }
}
