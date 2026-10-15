<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSectionResource\Pages;
use App\Models\SiteSection;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

/**
 * Administration des textes, images et visibilité des pages publiques.
 */
class SiteSectionResource extends Resource
{
    protected static ?string $model = SiteSection::class;

    protected static ?string $navigationLabel = 'Textes et rubriques';

    protected static ?string $modelLabel = 'Rubrique';

    protected static ?string $pluralModelLabel = 'Textes et rubriques';

    protected static string | UnitEnum | null $navigationGroup = 'Contenu du site';

    protected static ?int $navigationSort = 1;

    /**
     * Icône du menu : édition du contenu public.
     */
    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return 'heroicon-o-pencil-square';
    }

    /**
     * Les rubriques sont créées par le système. L'administrateur les modifie.
     */
    public static function canCreate(): bool
    {
        return false;
    }

    /**
     * Empêche la suppression d'une rubrique, pour ne pas casser la page qui l'affiche.
     */
    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Visibilité')
                    ->description('Décochez « Afficher sur le site » pour masquer cette rubrique partout où elle est utilisée.')
                    ->columns(2)
                    ->components([
                        TextInput::make('label')
                            ->label('Nom dans l\'administration')
                            ->helperText('Ce nom sert à retrouver la rubrique ici. Il n\'apparaît pas sur le site public.')
                            ->required()
                            ->maxLength(255),
                        Toggle::make('is_visible')
                            ->label('Afficher sur le site')
                            ->helperText('Décochez pour masquer le bloc ou le lien, sans effacer son contenu.')
                            ->default(true),
                        Textarea::make('help_text')
                            ->label('Aide')
                            ->disabled()
                            ->dehydrated(false)
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
                Section::make('Textes')
                    ->description('Laissez un champ vide seulement si cette rubrique ne l\'utilise pas. Le texte d\'aide ci-dessus précise le rôle de chaque champ.')
                    ->components([
                        TextInput::make('subtitle')
                            ->label('Sur-titre')
                            ->helperText('Petite ligne au-dessus du titre.')
                            ->maxLength(255),
                        TextInput::make('title')
                            ->label('Titre')
                            ->helperText('Titre principal, ou libellé du lien pour le menu.')
                            ->maxLength(255),
                        Textarea::make('body')
                            ->label('Texte')
                            ->helperText('Paragraphe principal. Les retours à la ligne sont conservés.')
                            ->rows(8),
                    ]),
                Section::make('Image')
                    ->description('Remplace l\'image du bloc. Les formats jpg, png et webp conviennent. Taille maximale : 4 Mo.')
                    ->components([
                        FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->directory('site-sections')
                            ->imageEditor()
                            ->maxSize(4096),
                    ]),
                Section::make('Bouton')
                    ->description('Laissez le lien vide pour conserver la page prévue (don, contact, équipe...). Vous pouvez aussi coller une adresse complète commençant par https://.')
                    ->columns(2)
                    ->components([
                        TextInput::make('button_label')
                            ->label('Texte du bouton')
                            ->maxLength(255),
                        TextInput::make('button_url')
                            ->label('Lien du bouton')
                            ->helperText('Nom de page (donate, about, contact, team, events, articles) ou adresse https://.')
                            ->maxLength(255),
                    ]),
                Section::make('Liste')
                    ->description('Puces, chiffres, volets ou photos. Selon la rubrique : remplissez le chiffre, le titre, le texte, ou la photo.')
                    ->components([
                        Repeater::make('items')
                            ->label('Éléments')
                            ->schema([
                                TextInput::make('number')
                                    ->label('Chiffre')
                                    ->helperText('Exemple : 3 000+. Laissez vide si ce n\'est pas un chiffre.')
                                    ->maxLength(50),
                                TextInput::make('title')
                                    ->label('Titre')
                                    ->maxLength(255),
                                Textarea::make('text')
                                    ->label('Texte')
                                    ->rows(3),
                                FileUpload::make('image')
                                    ->label('Photo')
                                    ->image()
                                    ->directory('site-sections')
                                    ->maxSize(4096),
                            ])
                            ->collapsible()
                            ->itemLabel(function (?array $state): ?string {
                                if ($state === null) {
                                    return 'Élément';
                                }

                                $label = $state['title'] ?? '';

                                if ($label === '') {
                                    $label = $state['number'] ?? '';
                                }

                                if ($label === '') {
                                    $label = $state['text'] ?? 'Élément';
                                }

                                return mb_strlen($label) > 80 ? mb_substr($label, 0, 80) . '…' : $label;
                            })
                            ->addActionLabel('Ajouter un élément'),
                    ]),
                Section::make('Coordonnées, réseaux et chiffres')
                    ->description('Utilisez seulement les champs cités dans l\'aide de la rubrique. Un champ vide est ignoré.')
                    ->collapsed()
                    ->columns(2)
                    ->components([
                        TextInput::make('extra.phone')
                            ->label('Téléphone')
                            ->tel()
                            ->maxLength(50),
                        TextInput::make('extra.email')
                            ->label('E-mail')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('extra.address')
                            ->label('Adresse')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('extra.map_embed')
                            ->label('Adresse de la carte')
                            ->helperText('Collez l\'URL d\'intégration Google Maps (elle contient output=embed ou /embed).')
                            ->rows(2)
                            ->columnSpanFull(),
                        TextInput::make('extra.facebook')->label('Facebook')->url()->maxLength(255),
                        TextInput::make('extra.twitter')->label('X / Twitter')->url()->maxLength(255),
                        TextInput::make('extra.instagram')->label('Instagram')->url()->maxLength(255),
                        TextInput::make('extra.linkedin')->label('LinkedIn')->url()->maxLength(255),
                        TextInput::make('extra.youtube')->label('YouTube')->url()->maxLength(255),
                        TextInput::make('extra.stat_number')->label('Chiffre mis en avant')->maxLength(50),
                        TextInput::make('extra.stat_label')->label('Légende du chiffre')->maxLength(255),
                        TextInput::make('extra.block_title')->label('Titre du bloc secondaire')->maxLength(255),
                        TextInput::make('extra.raised')->label('Montant collecté')->helperText('Laisser vide pour masquer la barre.')->maxLength(50),
                        TextInput::make('extra.goal')->label('Objectif')->maxLength(50),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page')
                    ->label('Page')
                    ->formatStateUsing(fn (string $state): string => SiteSection::PAGES[$state] ?? $state)
                    ->sortable(),
                Tables\Columns\TextColumn::make('label')
                    ->label('Rubrique')
                    ->searchable()
                    ->description(fn (SiteSection $record): string => $record->help_text ?? ''),
                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Affichée'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('page')
                    ->label('Page')
                    ->options(SiteSection::PAGES),
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Affichée'),
            ])
            ->actions([
                Actions\EditAction::make(),
            ]);
    }

    /**
     * Affiche d'abord les infos de base, puis les pages, dans l'ordre prévu.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderByRaw("FIELD(page, 'global', 'menu', 'home', 'about', 'contact', 'team', 'events', 'articles', 'donate')")
            ->orderBy('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSections::route('/'),
            'edit' => Pages\EditSiteSection::route('/{record}/edit'),
        ];
    }
}
