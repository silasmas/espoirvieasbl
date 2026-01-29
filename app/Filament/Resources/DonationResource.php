<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Models\Donation;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Illuminate\Contracts\Support\Htmlable;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationLabel = 'Dons';

    protected static ?string $modelLabel = 'Don';

    protected static ?string $pluralModelLabel = 'Dons';

    protected static ?int $navigationSort = 2;

    /**
     * Icône du menu Filament pour les dons uniques.
     */
    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return 'heroicon-o-banknotes';
    }

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
                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'one_time' => 'Don unique',
                                'recurring' => 'Don récurrent',
                            ])
                            ->default('one_time')
                            ->required(),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'pending' => 'En attente',
                                'completed' => 'Complété',
                                'failed' => 'Échoué',
                                'refunded' => 'Remboursé',
                            ])
                            ->default('pending')
                            ->required(),
                    ])->columns(2),
                Section::make('Paiement')
                    ->components([
                        TextInput::make('payment_method')
                            ->label('Méthode de paiement')
                            ->maxLength(255),
                        TextInput::make('payment_reference')
                            ->label('Référence de paiement')
                            ->maxLength(255),
                        TextInput::make('transaction_id')
                            ->label('ID de transaction')
                            ->maxLength(255),
                        DateTimePicker::make('paid_at')
                            ->label('Date de paiement'),
                    ])->columns(2),
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
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'one_time' => 'Unique',
                        'recurring' => 'Récurrent',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'refunded' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('paid_at')
                    ->label('Payé le')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'completed' => 'Complété',
                        'failed' => 'Échoué',
                        'refunded' => 'Remboursé',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'one_time' => 'Unique',
                        'recurring' => 'Récurrent',
                    ]),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'view' => Pages\ViewDonation::route('/{record}'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
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
