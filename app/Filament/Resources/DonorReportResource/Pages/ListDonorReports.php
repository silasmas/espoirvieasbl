<?php

namespace App\Filament\Resources\DonorReportResource\Pages;

use App\Filament\Resources\DonorReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonorReports extends ListRecords
{
    protected static string $resource = DonorReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
