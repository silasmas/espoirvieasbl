<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use App\Models\Admin;
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

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationLabel = 'Messages de contact';

    protected static ?string $modelLabel = 'Message';

    protected static ?string $pluralModelLabel = 'Messages';

    protected static ?int $navigationSort = 11;

    /**
     * Icône du menu Filament pour les messages de contact.
     */
    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return 'heroicon-o-inbox';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Message')
                    ->columns(2)
                    ->components([
                        TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->disabledOn('edit')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->disabledOn('edit')
                            ->maxLength(255),
                        TextInput::make('subject')
                            ->label('Sujet')
                            ->required()
                            ->disabledOn('edit')
                            ->columnSpanFull()
                            ->maxLength(255),
                        Textarea::make('message')
                            ->label('Message')
                            ->rows(6)
                            ->required()
                            ->disabledOn('edit')
                            ->columnSpanFull(),
                    ]),
                Section::make('Suivi interne')
                    ->columns(2)
                    ->components([
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'new' => 'Nouveau',
                                'in_progress' => 'En cours',
                                'replied' => 'Répondu',
                                'archived' => 'Archivé',
                            ])
                            ->default('new'),
                        Select::make('admin_id')
                            ->label('Assigné à')
                            ->options(Admin::query()->pluck('name', 'id'))
                            ->searchable()
                            ->helperText('Administrateur en charge de ce message.'),
                        Textarea::make('admin_notes')
                            ->label('Notes internes')
                            ->rows(4)
                            ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('subject')
                    ->label('Sujet')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'info',
                        'in_progress' => 'warning',
                        'replied' => 'success',
                        'archived' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('admin.name')
                    ->label('Assigné à')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Reçu le')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'new' => 'Nouveau',
                        'in_progress' => 'En cours',
                        'replied' => 'Répondu',
                        'archived' => 'Archivé',
                    ]),
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
            'index' => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}

