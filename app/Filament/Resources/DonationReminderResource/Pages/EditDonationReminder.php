<?php

namespace App\Filament\Resources\DonationReminderResource\Pages;

use App\Filament\Resources\DonationReminderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonationReminder extends EditRecord
{
    protected static string $resource = DonationReminderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
