<?php

namespace App\Filament\Client\Resources\HaccpPlans;

use App\Filament\Client\Resources\HaccpPlans\Pages\CreateHaccpPlan;
use App\Filament\Client\Resources\HaccpPlans\Pages\EditHaccpPlan;
use App\Filament\Client\Resources\HaccpPlans\Pages\ListHaccpPlans;
use App\Filament\Client\Resources\HaccpPlans\Schemas\HaccpPlanForm;
use App\Filament\Client\Resources\HaccpPlans\Tables\HaccpPlansTable;
use App\Models\HaccpPlan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HaccpPlanResource extends Resource
{
    protected static ?string $model = HaccpPlan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HaccpPlanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HaccpPlansTable::configure($table);
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
            'index' => ListHaccpPlans::route('/'),
            'create' => CreateHaccpPlan::route('/create'),
            'edit' => EditHaccpPlan::route('/{record}/edit'),
        ];
    }
}
