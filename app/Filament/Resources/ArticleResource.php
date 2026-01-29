<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Admin;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TagsInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Illuminate\Contracts\Support\Htmlable;
use BackedEnum;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationLabel = 'Articles';

    protected static ?string $modelLabel = 'Article';

    protected static ?string $pluralModelLabel = 'Articles';

    protected static ?int $navigationSort = 10;

    /**
     * Icône du menu Filament pour les articles / blog.
     */
    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return 'heroicon-o-newspaper';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contenu')
                    ->columns(2)
                    ->components([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->helperText('Laisser vide pour générer automatiquement à partir du titre.')
                            ->maxLength(255),
                        Textarea::make('excerpt')
                            ->label('Accroche')
                            ->rows(3)
                            ->maxLength(500),
                        Textarea::make('content')
                            ->label('Contenu')
                            ->rows(10)
                            ->required(),
                    ]),
                Section::make('Méta & visibilité')
                    ->columns(2)
                    ->components([
                        TextInput::make('category')
                            ->label('Catégorie')
                            ->maxLength(255),
                        TagsInput::make('tags')
                            ->label('Tags'),
                        Select::make('author_id')
                            ->label('Auteur (admin)')
                            ->options(Admin::query()->pluck('name', 'id'))
                            ->searchable()
                            ->helperText('Optionnel : lie l\'article à un administrateur.'),
                        TextInput::make('author_name')
                            ->label('Nom d\'auteur personnalisé')
                            ->helperText('Utilisé si aucun auteur admin n\'est sélectionné.')
                            ->maxLength(255),
                        Select::make('is_published')
                            ->label('Publié')
                            ->options([
                                1 => 'Oui',
                                0 => 'Non',
                            ])
                            ->default(0),
                        Select::make('is_featured')
                            ->label('Mis en avant')
                            ->options([
                                1 => 'Oui',
                                0 => 'Non',
                            ])
                            ->default(0),
                        DateTimePicker::make('published_at')
                            ->label('Date de publication')
                            ->seconds(false),
                    ]),
                Section::make('Image')
                    ->components([
                        FileUpload::make('image')
                            ->label('Image principale')
                            ->image()
                            ->directory('articles')
                            ->imageEditor()
                            ->maxSize(4096),
                    ]),
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
                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('author_display_name')
                    ->label('Auteur')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Mis en avant')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publié le')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('views_count')
                    ->label('Vues')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Publié'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Mis en avant'),
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
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}

