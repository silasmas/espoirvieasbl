<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationLabel = 'Activités';

    protected static ?string $modelLabel = 'Activité';

    protected static ?string $pluralModelLabel = 'Activités';

    protected static ?int $navigationSort = 3;

    /**
     * Icône du menu Filament pour les activités / projets.
     */
    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return 'heroicon-o-clipboard-document-list';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations de base')
                    ->components([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->required(),
                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'project' => 'Projet',
                                'event' => 'Événement',
                                'campaign' => 'Campagne',
                                'program' => 'Programme',
                                'other' => 'Autre',
                            ])
                            ->default('project')
                            ->required(),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'planned' => 'Planifié',
                                'ongoing' => 'En cours',
                                'completed' => 'Terminé',
                                'cancelled' => 'Annulé',
                                'on_hold' => 'En attente',
                            ])
                            ->default('planned')
                            ->required(),
                    ])->columns(2),
                Section::make('Dates et localisation')
                    ->components([
                        DatePicker::make('start_date')
                            ->label('Date de début')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Date de fin'),
                        TextInput::make('location')
                            ->label('Lieu')
                            ->maxLength(255),
                        TextInput::make('country')
                            ->label('Pays')
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('Budget')
                    ->components([
                        TextInput::make('budget')
                            ->label('Budget')
                            ->numeric()
                            ->prefix('€'),
                        TextInput::make('amount_raised')
                            ->label('Montant collecté')
                            ->numeric()
                            ->prefix('€'),
                        TextInput::make('amount_spent')
                            ->label('Montant dépensé')
                            ->numeric()
                            ->prefix('€'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'ongoing' => 'info',
                        'planned' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Date de début')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget')
                    ->label('Budget')
                    ->money('EUR')
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
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type'),
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
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'view' => Pages\ViewActivity::route('/{record}'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
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
