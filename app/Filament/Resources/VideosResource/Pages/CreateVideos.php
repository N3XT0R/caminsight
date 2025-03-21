<?php

namespace App\Filament\Resources\VideosResource\Pages;

use App\Filament\Resources\VideosResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Owenoj\LaravelGetId3\GetId3;

class CreateVideos extends CreateRecord
{
    protected static string $resource = VideosResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title(__('forms.video.messages.uploaded.title'))
            ->body(__('forms.video.messages.uploaded.body'));
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('file_path')
                ->label(__('forms.video.video_file'))
                ->required()
                ->storeFileNamesIn('file_name')
                ->acceptedFileTypes(['video/mp4'])
                ->multiple(false)
                ->panelLayout('integrated')
                ->moveFiles()
                ->mimeTypeMap([
                    'mp4' => 'video/mp4',
                ])
                ->disk('videos')
                ->directory(auth()->id())
                ->visibility('public'),
            Textarea::make('comment')->label(__('forms.video.comment')),
        ]);
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $diskName = 'videos';
        $filePath = $data['file_path'];
        $disk = Storage::disk($diskName);
        $getID3 = GetId3::fromDiskAndPath($diskName, $filePath);
        $fileInfo = $getID3->extractInfo();
        $data['user_id'] = auth()->id();
        $data['file_size'] = $disk->size($filePath);
        $data['hash_sum'] = md5($disk->get($filePath));
        $data['type'] = $disk->mimeType($filePath);
        $data['meta_data'] = $fileInfo;

        return $data;
    }
}
