<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Création d'un témoignage.
 */
class CreateTestimonial extends CreateRecord
{
    protected static string $resource = TestimonialResource::class;
}
