<?php

namespace App\Filament\Resources\VideosResource\Pages;

use App\Filament\Resources\VideosResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

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
            FileUpload::make('attachment')
                ->label('Video-File')
                ->required()
                ->acceptedFileTypes(['video/mp4'])
                ->mimeTypeMap([
                    'mp4' => 'video/mp4',
                ])
                ->preserveFilenames()
                ->disk('videos')
                ->directory(auth()->id())
                ->visibility('private')
        ]);
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        dd($data);

        return $data;
    }
}
