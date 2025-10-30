<?php

namespace App\Filament\Client\Resources\BasicDocuments\Pages;

use App\Filament\Client\Resources\BasicDocuments\BasicDocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBasicDocument extends EditRecord
{
    protected static string $resource = BasicDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
