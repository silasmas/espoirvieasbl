<?php

namespace App\Filament\Resources\RecurringDonationResource\Pages;

use App\Filament\Resources\RecurringDonationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecurringDonation extends EditRecord
{
    protected static string $resource = RecurringDonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
