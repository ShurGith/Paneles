<?php

    namespace App\Filament\Resources\PatientResource\Pages;

    use App\Filament\Resources\PatientResource;
    use Filament\Actions;
    use Filament\Resources\Pages\ViewRecord;
    use Filament\Tables\Table;

    class ViewPatient extends ViewRecord
    {
        protected static string $resource = PatientResource::class;

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    Tables\Columns\TextColumn::make('name')
                        ->label('Raza')
                        ->sortable()
                        ->searchable(),
                ]);
        }

        protected function getHeaderActions(): array
        {
            return [
                Actions\EditAction::make(),
            ];
        }
    }
