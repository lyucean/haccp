<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeadsStatusWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $newLeads = Lead::where('status', 'new')->count();
        $emailSent = Lead::where('status', 'email_sent')->count();
        $telegramSent = Lead::where('status', 'telegram_sent')->count();
        $called = Lead::where('status', 'called')->count();
        $completed = Lead::where('status', 'completed')->count();
        
        return [
            Stat::make('Новые заявки', $newLeads)
                ->description('Требуют обработки')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
                
            Stat::make('Отправлено письмо', $emailSent)
                ->description('Письма отправлены')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),
                
            Stat::make('Отписали в телегу', $telegramSent)
                ->description('Уведомления в Telegram')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('info'),
                
            Stat::make('Прозвонили', $called)
                ->description('Звонки совершены')
                ->descriptionIcon('heroicon-m-phone')
                ->color('primary'),
                
            Stat::make('Завершено', $completed)
                ->description('Заявки закрыты')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
