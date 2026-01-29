<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Illuminate\Contracts\Support\Htmlable;
use BackedEnum;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationLabel = 'Équipe';

    protected static ?string $modelLabel = 'Membre de l\'équipe';

    protected static ?string $pluralModelLabel = 'Membres de l\'équipe';

    protected static ?int $navigationSort = 9;

    /**
     * Icône du menu Filament pour l'équipe (administrateurs).
     */
    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return 'heroicon-o-user-group';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations principales')
                    ->columns(2)
                    ->components([
                        TextInput::make('name')
                            ->label('Nom complet')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('password')
                            ->label('Mot de passe')
                            ->password()
                            ->dehydrateStateUsing(fn (?string $state) => filled($state) ? $state : null)
                            ->required(fn (string $operation) => $operation === 'create')
                            ->maxLength(255),
                        TextInput::make('position')
                            ->label('Poste / Rôle')
                            ->maxLength(255),
                    ]),
                Section::make('Biographie & photo')
                    ->columns(2)
                    ->components([
                        FileUpload::make('photo')
                            ->label('Photo')
                            ->directory('team')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('1:1')
                            ->maxSize(2048),
                        Textarea::make('bio')
                            ->label('Biographie')
                            ->rows(5),
                    ]),
                Section::make('Réseaux sociaux')
                    ->columns(2)
                    ->components([
                        TextInput::make('facebook_url')
                            ->label('Facebook')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('twitter_url')
                            ->label('X / Twitter')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('linkedin_url')
                            ->label('LinkedIn')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('instagram_url')
                            ->label('Instagram')
                            ->url()
                            ->maxLength(255),
                    ]),
                Section::make('Affichage sur la page "Notre équipe"')
                    ->columns(2)
                    ->components([
                        Select::make('is_team_visible')
                            ->label('Afficher dans la section équipe')
                            ->options([
                                1 => 'Oui',
                                0 => 'Non',
                            ])
                            ->default(1),
                        TextInput::make('team_order')
                            ->label('Ordre d\'affichage')
                            ->numeric()
                            ->minValue(0)
                            ->helperText('Plus le nombre est petit, plus le membre apparaît en haut de la liste.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Poste')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_team_visible')
                    ->label('Visible dans l\'équipe')
                    ->boolean(),
                Tables\Columns\TextColumn::make('team_order')
                    ->label('Ordre')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_team_visible')
                    ->label('Visible dans l\'équipe'),
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'view' => Pages\ViewAdmin::route('/{record}'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}

