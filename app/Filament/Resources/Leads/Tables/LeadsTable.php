<?php

namespace App\Filament\Resources\Leads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                        \Filament\Tables\Columns\TextColumn::make('name')
                            ->label('Имя')
                            ->searchable()
                            ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('company_name')
                    ->label('Компания')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('action')
                    ->label('Тип заявки')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'register' => 'success',
                        'login' => 'info',
                        'contact' => 'warning',
                        'demo' => 'primary',
                        'newsletter' => 'secondary',
                        default => 'gray',
                    }),
                        \Filament\Tables\Columns\TextColumn::make('source')
                            ->label('Источник')
                            ->searchable(),
                        \Filament\Tables\Columns\TextColumn::make('status')
                            ->label('Статус')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'new' => 'danger',
                                'email_sent' => 'warning',
                                'telegram_sent' => 'info',
                                'called' => 'primary',
                                'completed' => 'success',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'new' => 'Новая заявка',
                                'email_sent' => 'Отправлено письмо',
                                'telegram_sent' => 'Отписали в телегу',
                                'called' => 'Прозвонили',
                                'completed' => 'Завершено',
                                default => $state,
                            }),
                        \Filament\Tables\Columns\TextColumn::make('manager_comment')
                            ->label('Комментарий')
                            ->limit(100)
                            ->tooltip(function (TextColumn $column): ?string {
                                $state = $column->getState();
                                if (strlen($state) <= 100) {
                                    return null;
                                }
                                return $state;
                            }),
                        \Filament\Tables\Columns\TextColumn::make('created_at')
                            ->label('Дата создания')
                            ->dateTime()
                            ->sortable(),
            ])
            ->filters([
                        \Filament\Tables\Filters\SelectFilter::make('status')
                            ->label('Статус')
                            ->options([
                                'new' => 'Новая заявка',
                                'email_sent' => 'Отправлено письмо',
                                'telegram_sent' => 'Отписали в телегу',
                                'called' => 'Прозвонили',
                                'completed' => 'Завершено',
                            ]),
                        \Filament\Tables\Filters\SelectFilter::make('action')
                            ->label('Тип заявки')
                            ->options([
                                'register' => 'Регистрация',
                                'login' => 'Вход',
                                'contact' => 'Контакт',
                                'demo' => 'Демо',
                                'newsletter' => 'Подписка',
                            ]),
                \Filament\Tables\Filters\Filter::make('created_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('created_from')
                            ->label('С даты'),
                        \Filament\Forms\Components\DatePicker::make('created_until')
                            ->label('По дату'),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
