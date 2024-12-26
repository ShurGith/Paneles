<?php

namespace App\Filament\Resources\RazaResource\Pages;

use App\Filament\Resources\RazaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRaza extends EditRecord
{
    protected static string $resource = RazaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
