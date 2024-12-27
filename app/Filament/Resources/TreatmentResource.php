<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\TreatmentResource\Pages;
    use App\Filament\Resources\TreatmentResource\RelationManagers;
    use App\Models\Treatment;
    use Filament\Forms\Components\RichEditor;
    use Filament\Forms\Components;
    use Filament\Forms\Components\Section;
    use Filament\Forms\Form;
    use Filament\Infolists\Infolist;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;
    use Filament\Infolists\Components\TextEntry;
    use Filament\Infolists\Components\Section as SectionInfoList;

    class TreatmentResource extends Resource
    {
        protected static ?string $model = Treatment::class;
        protected static ?string $navigationLabel = "Tratamientos";
        protected static ?string $navigationGroup = 'Listado';
        protected static ?string $navigationIcon = 'icon-linux';//'heroicon-o-banknotes';
        //protected static ?string $activeNavigationIcon = 'heroicon-o-document-text';
        protected static ?int $navigationSort = 3;

        public static function form(Form $form): Form
        {
            return $form
                ->schema([
//                    TextInput::make('patient.name')
//                        ->label('Paciente'),
                   Section::make('Descripción de todos los datos')
                        ->description('Prevent abuse by limiting the number of requests per period')
                        ->schema([
                            RichEditor::make('description')
                        ]),
                   Section::make('Notas y otras cosas')
                        ->description('Prevent abuse by limiting the number of requests per period')
                        ->schema([
                            RichEditor::make('notes')
                        ]),
                ]);
        }

        public static function infolist(Infolist $infolist): Infolist
        {

            return $infolist

           ->schema([

               SectionInfoList::make()
                   ->schema([

                           TextEntry::make('name'),
                           TextEntry::make('description')
                               ->html(),
                           TextEntry::make('notes')
                               ->html(),
                   ])
                   ->schema([
                       TextEntry::make('name'),
                       TextEntry::make('description')
                           ->html(),
                       TextEntry::make('notes')
                           ->html(),
                   ])

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
                             ->html()
                             ->wrap(),
                         Tables\Columns\TextColumn::make('notes')
                             ->label('Notas')
                             ->html()
                             ->wrap()
                     ])
                     ->filters([
                         //
                     ])
                     ->actions([
                         Tables\Actions\ViewAction::make()
                             ->slideOver()
                             ->modalWidth('full')
                             ->button(),
                         Tables\Actions\EditAction::make()
                            ->button(),
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
                'edit' => Pages\EditTreatment::route('/{record}/edit'),
            ];
        }
    }
