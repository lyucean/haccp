<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class LeadsStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        
        $todayLeads = Lead::whereDate('created_at', $today)->count();
        $yesterdayLeads = Lead::whereDate('created_at', $yesterday)->count();
        $totalLeads = Lead::count();
        
        return [
            Stat::make('Заявок сегодня', $todayLeads)
                ->description('Новых заявок за сегодня')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Заявок вчера', $yesterdayLeads)
                ->description('Заявок за вчера')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
                
            Stat::make('Всего заявок', $totalLeads)
                ->description('Общее количество заявок')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
        ];
    }
}
