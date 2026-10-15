<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
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

/**
 * Gestion des témoignages affichés sur le site.
 * N'enregistrez que des propos réellement autorisés.
 */
class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationLabel = 'Témoignages';

    protected static ?string $modelLabel = 'Témoignage';

    protected static ?string $pluralModelLabel = 'Témoignages';

    protected static string | \UnitEnum | null $navigationGroup = 'Contenu du site';

    protected static ?int $navigationSort = 2;

    /**
     * Icône du menu des témoignages.
     */
    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return 'heroicon-o-chat-bubble-left-right';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Témoignage')
                    ->description('Texte prononcé par une personne réelle. Laissez « Affiché » décoché tant que le propos n\'est pas confirmé.')
                    ->components([
                        TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('role')
                            ->label('Fonction')
                            ->helperText('Exemple : parent, bénévole, partenaire.')
                            ->maxLength(255),
                        Textarea::make('content')
                            ->label('Texte')
                            ->required()
                            ->rows(5),
                        TextInput::make('rating')
                            ->label('Note sur 5')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->default(5),
                        TextInput::make('display_order')
                            ->label('Ordre d\'affichage')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Affiché sur le site')
                            ->default(false),
                    ]),
                Section::make('Photo')
                    ->components([
                        FileUpload::make('photo')
                            ->label('Photo')
                            ->image()
                            ->directory('testimonials')
                            ->maxSize(4096),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Fonction'),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Affiché'),
                Tables\Columns\TextColumn::make('display_order')
                    ->label('Ordre')
                    ->sortable(),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->defaultSort('display_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
