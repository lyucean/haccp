<?php

namespace App\Filament\Client\Resources\HaccpPlans\Pages;

use App\Filament\Client\Resources\HaccpPlans\HaccpPlanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHaccpPlan extends EditRecord
{
    protected static string $resource = HaccpPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
