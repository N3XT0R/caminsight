<x-filament::page>
    <video controls>
        <source src="{{ asset('videos/'.$this->record->file_path) }}" type="{{ $this->record->type }}">
        Your browser does not support the video tag.
    </video>
</x-filament::page>