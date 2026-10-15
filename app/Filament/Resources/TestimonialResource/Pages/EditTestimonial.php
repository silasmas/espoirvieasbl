<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Resources\Pages\EditRecord;

/**
 * Modification d'un témoignage.
 */
class EditTestimonial extends EditRecord
{
    protected static string $resource = TestimonialResource::class;
}
