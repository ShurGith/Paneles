<?php

namespace App\Filament\Resources\RazaResource\Pages;

use App\Filament\Resources\RazaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRazas extends ListRecords
{
    protected static string $resource = RazaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
