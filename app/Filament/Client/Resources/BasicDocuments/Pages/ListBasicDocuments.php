<?php

namespace App\Filament\Client\Resources\BasicDocuments\Pages;

use App\Filament\Client\Resources\BasicDocuments\BasicDocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBasicDocuments extends ListRecords
{
    protected static string $resource = BasicDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
