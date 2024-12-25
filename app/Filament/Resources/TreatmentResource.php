<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\TreatmentResource\Pages;
    use App\Filament\Resources\TreatmentResource\RelationManagers;
    use App\Models\Treatment;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;

    class TreatmentResource extends Resource
    {
        protected static ?string $model = Treatment::class;
        protected static ?string $navigationLabel = "Tratamientos";
        protected static ?string $navigationGroup = 'Listado';
        protected static ?string $navigationIcon = 'heroicon-o-banknotes';
        //protected static ?string $activeNavigationIcon = 'heroicon-o-document-text';
        protected static ?int $navigationSort = 3;

        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    //
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([Tables\Columns\TextColumn::make('patient.name')
                    ->label('Paciente')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('description')
                        ->label('Descripción')
                        ->sortable(),
                    Tables\Columns\TextColumn::make('notes')
                        ->label('Notas')
                        ->sortable()
                ])
                ->filters([
                    //
                ])
                ->actions([
                    Tables\Actions\EditAction::make()
                        ->slideOver(),
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ]),
                ]);
        }

        public static function getRelations(): array
        {
            return [
                //
            ];
        }

        public static function getPages(): array
        {
            return [
                'index' => Pages\ListTreatments::route('/'),
                'create' => Pages\CreateTreatment::route('/create'),
                //'edit' => Pages\EditTreatment::route('/{record}/edit'),
            ];
        }
    }
