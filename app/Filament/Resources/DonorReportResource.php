<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonorReportResource\Pages;
use App\Models\DonorReport;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

class DonorReportResource extends Resource
{
    protected static ?string $model = DonorReport::class;

    protected static ?string $navigationLabel = 'Rapports envoyés';

    protected static ?string $modelLabel = 'Rapport envoyé';

    protected static ?string $pluralModelLabel = 'Rapports envoyés';

    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations')
                    ->components([
                        Select::make('donor_id')
                            ->label('Donateur')
                            ->relationship('donor', 'email')
                            ->searchable()
                            ->required(),
                        Select::make('report_id')
                            ->label('Rapport')
                            ->relationship('report', 'title')
                            ->searchable()
                            ->required(),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'pending' => 'En attente',
                                'sent' => 'Envoyé',
                                'failed' => 'Échoué',
                                'bounced' => 'Rejeté',
                            ])
                            ->default('pending')
                            ->required(),
                    ])->columns(3),
                Section::make('Suivi')
                    ->components([
                        DateTimePicker::make('sent_at')
                            ->label('Date d\'envoi'),
                        DateTimePicker::make('opened_at')
                            ->label('Date d\'ouverture'),
                        DateTimePicker::make('clicked_at')
                            ->label('Date de clic'),
                        Toggle::make('email_opened')
                            ->label('Email ouvert'),
                        Toggle::make('link_clicked')
                            ->label('Lien cliqué'),
                        Toggle::make('report_viewed')
                            ->label('Rapport consulté'),
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
                Tables\Columns\TextColumn::make('report.title')
                    ->label('Rapport')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sent' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'bounced' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('sent_at')
                    ->label('Envoyé le')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('email_opened')
                    ->label('Ouvert')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('report_viewed')
                    ->label('Consulté')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('view_count')
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
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut'),
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
            'index' => Pages\ListDonorReports::route('/'),
            'create' => Pages\CreateDonorReport::route('/create'),
            'edit' => Pages\EditDonorReport::route('/{record}/edit'),
        ];
    }
}
