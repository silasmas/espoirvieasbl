<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonorResource\Pages;
use App\Models\Donor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonorResource extends Resource
{ 
    protected static ?string $model = Donor::class;

    protected static ?string $navigationLabel = 'Donateurs';

    protected static ?string $modelLabel = 'Donateur';

    protected static ?string $pluralModelLabel = 'Donateurs';

    /**
     * Icône du menu Filament pour les donateurs.
     *
     * Utilise un pictogramme de groupe d'utilisateurs pour représenter
     * la liste des donateurs dans la barre latérale de Filament.
     */
    public static function getNavigationIcon(): string|\BackedEnum|\Illuminate\Contracts\Support\Htmlable|null
    {
        return 'heroicon-o-users';
    }

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations personnelles')
                    ->components([
                        TextInput::make('first_name')
                            ->label('Prénom')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Téléphone')
                            ->tel()
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('Adresse')
                    ->components([
                        Textarea::make('address')
                            ->label('Adresse')
                            ->rows(2)
                            ->maxLength(65535),
                        TextInput::make('city')
                            ->label('Ville')
                            ->maxLength(255),
                        TextInput::make('postal_code')
                            ->label('Code postal')
                            ->maxLength(255),
                        TextInput::make('country')
                            ->label('Pays')
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('Préférences')
                    ->components([
                        Toggle::make('wants_reports')
                            ->label('Souhaite recevoir les rapports')
                            ->default(true),
                        Toggle::make('wants_newsletter')
                            ->label('Souhaite recevoir la newsletter')
                            ->default(false),
                        Toggle::make('is_anonymous')
                            ->label('Don anonyme')
                            ->default(false),
                    ])->columns(3),
                Section::make('Informations fiscales')
                    ->components([
                        TextInput::make('tax_id')
                            ->label('Numéro d\'identification fiscale')
                            ->maxLength(255),
                        TextInput::make('company_name')
                            ->label('Nom de l\'entreprise')
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('Statut')
                    ->components([
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'active' => 'Actif',
                                'inactive' => 'Inactif',
                                'unsubscribed' => 'Désabonné',
                            ])
                            ->default('active')
                            ->required(),
                        Textarea::make('notes')
                            ->label('Notes internes')
                            ->rows(3)
                            ->maxLength(65535),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total_donated')
                    ->label('Total donné')
                    ->money('EUR')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('last_donation_at')
                    ->label('Dernier don')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'warning',
                        'unsubscribed' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Actif',
                        'inactive' => 'Inactif',
                        'unsubscribed' => 'Désabonné',
                        default => $state,
                    }),
                Tables\Columns\IconColumn::make('wants_reports')
                    ->label('Rapports')
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
                    ->label('Statut')
                    ->options([
                        'active' => 'Actif',
                        'inactive' => 'Inactif',
                        'unsubscribed' => 'Désabonné',
                    ]),
                Tables\Filters\TernaryFilter::make('wants_reports')
                    ->label('Souhaite recevoir les rapports'),
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
            'index' => Pages\ListDonors::route('/'),
            'create' => Pages\CreateDonor::route('/create'),
            'view' => Pages\ViewDonor::route('/{record}'),
            'edit' => Pages\EditDonor::route('/{record}/edit'),
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
