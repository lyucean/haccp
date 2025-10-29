<?php

namespace App\Filament\Client\Widgets;

use Filament\Widgets\Widget;

class DocumentSelectionWidget extends Widget
{
    protected static string $view = 'filament.client.widgets.document-selection-widget';
    
    protected int | string | array $columnSpan = 'full';
}
