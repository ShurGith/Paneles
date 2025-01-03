<?php

    namespace App\Filament\Resources\OwnerResource\Pages;

    use App\Filament\Resources\OwnerResource;
    use Filament\Actions;
    use Filament\Resources\Pages\EditRecord;

    class EditOwner extends EditRecord
    {
        protected static string $resource = OwnerResource::class;

        public function getTitle(): string
        {
            return "Cliente: " . $this->record->name;
        }

        protected function getHeaderActions(): array
        {

            return [
                Actions\DeleteAction::make(),
            ];
        }
    }
