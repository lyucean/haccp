<?php

namespace App\Filament\Client\Resources\BasicDocuments;

use App\Filament\Client\Resources\BasicDocuments\Pages\CreateBasicDocument;
use App\Filament\Client\Resources\BasicDocuments\Pages\EditBasicDocument;
use App\Filament\Client\Resources\BasicDocuments\Pages\ListBasicDocuments;
use App\Filament\Client\Resources\BasicDocuments\Schemas\BasicDocumentForm;
use App\Filament\Client\Resources\BasicDocuments\Tables\BasicDocumentsTable;
use App\Models\BasicDocument;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BasicDocumentResource extends Resource
{
    protected static ?string $model = BasicDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return BasicDocumentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BasicDocumentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBasicDocuments::route('/'),
            'create' => CreateBasicDocument::route('/create'),
            'edit' => EditBasicDocument::route('/{record}/edit'),
        ];
    }
}
