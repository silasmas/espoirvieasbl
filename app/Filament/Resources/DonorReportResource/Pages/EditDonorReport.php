<?php

namespace App\Filament\Resources\DonorReportResource\Pages;

use App\Filament\Resources\DonorReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonorReport extends EditRecord
{
    protected static string $resource = DonorReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
