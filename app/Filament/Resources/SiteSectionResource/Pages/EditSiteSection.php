<?php

namespace App\Filament\Resources\SiteSectionResource\Pages;

use App\Filament\Resources\SiteSectionResource;
use Filament\Resources\Pages\EditRecord;

/**
 * Modification d'une rubrique : textes, image et visibilité.
 */
class EditSiteSection extends EditRecord
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
