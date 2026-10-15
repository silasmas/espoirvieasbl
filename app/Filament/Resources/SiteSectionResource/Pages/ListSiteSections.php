<?php

namespace App\Filament\Resources\SiteSectionResource\Pages;

use App\Filament\Resources\SiteSectionResource;
use Filament\Resources\Pages\ListRecords;

/**
 * Liste des rubriques, sans bouton de création.
 */
class ListSiteSections extends ListRecords
{
    protected static string $resource = SiteSectionResource::class;

    /**
     * @return array<int, mixed>
     */
    protected function getHeaderActions(): array
    {
        return [];
    }
}
