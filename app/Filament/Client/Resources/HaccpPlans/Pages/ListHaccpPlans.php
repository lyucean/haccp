<?php

namespace App\Filament\Client\Resources\HaccpPlans\Pages;

use App\Filament\Client\Resources\HaccpPlans\HaccpPlanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHaccpPlans extends ListRecords
{
    protected static string $resource = HaccpPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
