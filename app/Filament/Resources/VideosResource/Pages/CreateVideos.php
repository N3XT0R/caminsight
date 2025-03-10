<?php

namespace App\Filament\Resources\VideosResource\Pages;

use App\Filament\Resources\VideosResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateVideos extends CreateRecord
{
    protected static string $resource = VideosResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('file_path')
                ->label('Video-File')
                ->required()
                ->storeFileNamesIn('file_name')
                ->acceptedFileTypes(['video/mp4'])
                ->mimeTypeMap([
                    'mp4' => 'video/mp4',
                ])
                ->disk('videos')
                ->directory(auth()->id())
                ->visibility('public'),
            Textarea::make('comment')->label('Kommentar'),
        ]);
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $filePath = $data['file_path'];
        $disk = Storage::disk('videos');
        $data['user_id'] = auth()->id();
        $data['file_size'] = $disk->size($filePath);
        $data['hash_sum'] = md5($disk->get($filePath));
        $data['type'] = $disk->mimeType($filePath);

        return $data;
    }
}
