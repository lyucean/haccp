<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('phone')
                    ->label('Телефон')
                    ->tel()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('company_name')
                    ->label('Название компании')
                    ->maxLength(255),
                \Filament\Forms\Components\Select::make('action')
                    ->label('Тип заявки')
                    ->options([
                        'register' => 'Регистрация',
                        'login' => 'Вход',
                        'contact' => 'Контакт',
                        'demo' => 'Демо',
                        'newsletter' => 'Подписка',
                    ])
                    ->required(),
                \Filament\Forms\Components\TextInput::make('source')
                    ->label('Источник')
                    ->maxLength(255),
                        \Filament\Forms\Components\Textarea::make('message')
                            ->label('Сообщение')
                            ->rows(3),
                        \Filament\Forms\Components\Select::make('status')
                            ->label('Статус')
                            ->options([
                                'new' => 'Новая заявка',
                                'email_sent' => 'Отправлено письмо',
                                'telegram_sent' => 'Отписали в телегу',
                                'called' => 'Прозвонили',
                                'completed' => 'Завершено',
                            ])
                            ->default('new')
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('manager_comment')
                            ->label('Комментарий менеджера')
                            ->rows(3),
                        \Filament\Forms\Components\TextInput::make('ip_address')
                            ->label('IP адрес')
                            ->maxLength(45),
            ]);
    }
}
