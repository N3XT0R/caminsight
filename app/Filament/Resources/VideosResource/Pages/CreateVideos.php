<?php

namespace App\Filament\Resources\VideosResource\Pages;

use App\Filament\Resources\VideosResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class CreateVideos extends CreateRecord
{
    protected static string $resource = VideosResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title(__('forms.video.video_file.messages.uploaded.title'))
            ->body(__('forms.video.video_file.messages.uploaded.body'));
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
        $getID3 = new \getID3();
        $filePath = $data['file_path'];
        $fileInfo = $getID3->analyze($filePath);
        $getID3->CopyTagsToComments($fileInfo);
        $disk = Storage::disk('videos');
        $data['user_id'] = auth()->id();
        $data['file_size'] = $disk->size($filePath);
        $data['hash_sum'] = md5($disk->get($filePath));
        $data['type'] = $disk->mimeType($filePath);
        $data['play_time'] = $fileInfo['playtime_seconds'];

        return $data;
    }
}
