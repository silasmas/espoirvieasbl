<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationReminderResource\Pages;
use App\Models\DonationReminder;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

class DonationReminderResource extends Resource
{
    protected static ?string $model = DonationReminder::class;

    protected static ?string $navigationLabel = 'Rappels de dons';

    protected static ?string $modelLabel = 'Rappel';

    protected static ?string $pluralModelLabel = 'Rappels';

    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations')
                    ->components([
                        Select::make('recurring_donation_id')
                            ->label('Don récurrent')
                            ->relationship('recurringDonation', 'id')
                            ->searchable()
                            ->required(),
                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'upcoming' => 'À venir',
                                'overdue' => 'En retard',
                                'payment_failed' => 'Échec de paiement',
                                'renewal' => 'Renouvellement',
                            ])
                            ->default('upcoming')
                            ->required(),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'pending' => 'En attente',
                                'sent' => 'Envoyé',
                                'failed' => 'Échoué',
                                'cancelled' => 'Annulé',
                            ])
                            ->default('pending')
                            ->required(),
                    ])->columns(3),
                Section::make('Dates')
                    ->components([
                        DatePicker::make('scheduled_date')
                            ->label('Date programmée')
                            ->required(),
                        DatePicker::make('donation_due_date')
                            ->label('Date due')
                            ->required(),
                        DateTimePicker::make('sent_at')
                            ->label('Date d\'envoi'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('donor.email')
                    ->label('Donateur')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sent' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'cancelled' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('scheduled_date')
                    ->label('Date programmée')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sent_at')
                    ->label('Envoyé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('email_opened')
                    ->label('Ouvert')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut'),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type'),
            ])
            ->actions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonationReminders::route('/'),
            'create' => Pages\CreateDonationReminder::route('/create'),
            'edit' => Pages\EditDonationReminder::route('/{record}/edit'),
        ];
    }
}
