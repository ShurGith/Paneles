<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\RazaResource\Pages;
    use App\Filament\Resources\RazaResource\RelationManagers;
    use App\Models\Animal;
    use App\Models\Raza;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Forms\Get;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Table;

    class RazaResource extends Resource
    {
        protected static ?string $model = Raza::class;

        protected static ?string $navigationLabel = "Configurar Razas";
        protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
        protected static ?string $navigationGroup = 'Datos Genéricos';
        protected static ?int $navigationSort = 11;

        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Raza')
                        ->required(),
                    Forms\Components\Select::make('animal_id')
                        ->options(
                            fn(Get $get) => Animal::query()
                                ->orderBy('name')
                                ->pluck('name', 'id')
                        )
                        ->searchable()
                        ->label('Animal')
                        ->required(),
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    TextColumn::make('name')
                        ->label('Raza')
                        ->html()
                        ->sortable()
                        ->tooltip(function ($record) {
                            return $record->animal->name;
                        })
                        ->getStateUsing(function ($record) {
                            return $record->name . '<img class="w-10 h-10" src="/storage/images/animales/' . $record->animal->name . '.png">';
                        }),
                    TextColumn::make('animal.name')
                        ->label('Animal')
                        ->sortable()
                        ->width('70%'),
                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true)
                ])
                ->defaultSort('animal.name')
                ->filters([
                    //
                ])
                ->actions([
                    Tables\Actions\EditAction::make(),

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
                'index' => Pages\ListRazas::route('/'),
                // 'create' => Pages\CreateRaza::route('/create'),
                //'edit' => Pages\EditRaza::route('/{record}/edit'),
            ];
        }
    }
