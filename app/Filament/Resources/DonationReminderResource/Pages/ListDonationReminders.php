<?php

namespace App\Filament\Resources\DonationReminderResource\Pages;

use App\Filament\Resources\DonationReminderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonationReminders extends ListRecords
{
    protected static string $resource = DonationReminderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
