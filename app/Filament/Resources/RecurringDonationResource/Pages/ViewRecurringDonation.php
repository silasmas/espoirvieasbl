<?php

namespace App\Filament\Resources\RecurringDonationResource\Pages;

use App\Filament\Resources\RecurringDonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRecurringDonation extends ViewRecord
{
    protected static string $resource = RecurringDonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
