<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecurringDonationResource\Pages;
use App\Models\RecurringDonation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecurringDonationResource extends Resource
{
    protected static ?string $model = RecurringDonation::class;

    protected static ?string $navigationLabel = 'Dons récurrents';

    protected static ?string $modelLabel = 'Don récurrent';

    protected static ?string $pluralModelLabel = 'Dons récurrents';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations du don')
                    ->components([
                        Select::make('donor_id')
                            ->label('Donateur')
                            ->relationship('donor', 'email')
                            ->searchable()
                            ->required(),
                        TextInput::make('amount')
                            ->label('Montant')
                            ->numeric()
                            ->required()
                            ->prefix('€'),
                        Select::make('frequency')
                            ->label('Fréquence')
                            ->options([
                                'monthly' => 'Mensuel',
                                'quarterly' => 'Trimestriel',
                                'biannual' => 'Semestriel',
                                'annual' => 'Annuel',
                            ])
                            ->default('monthly')
                            ->required(),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'active' => 'Actif',
                                'paused' => 'En pause',
                                'cancelled' => 'Annulé',
                                'expired' => 'Expiré',
                                'failed' => 'Échoué',
                            ])
                            ->default('active')
                            ->required(),
                    ])->columns(2),
                Section::make('Dates')
                    ->components([
                        DatePicker::make('start_date')
                            ->label('Date de début')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Date de fin'),
                        DatePicker::make('next_donation_date')
                            ->label('Prochain prélèvement')
                            ->required(),
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
                Tables\Columns\TextColumn::make('amount')
                    ->label('Montant')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('frequency')
                    ->label('Fréquence')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'paused' => 'warning',
                        'cancelled' => 'danger',
                        'expired' => 'gray',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('next_donation_date')
                    ->label('Prochain prélèvement')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_donations')
                    ->label('Total dons')
                    ->sortable()
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
                Tables\Filters\SelectFilter::make('frequency')
                    ->label('Fréquence'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
                Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                    Actions\RestoreBulkAction::make(),
                    Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecurringDonations::route('/'),
            'create' => Pages\CreateRecurringDonation::route('/create'),
            'view' => Pages\ViewRecurringDonation::route('/{record}'),
            'edit' => Pages\EditRecurringDonation::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
