<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\AnimalResource\Pages;
    use App\Filament\Resources\AnimalResource\RelationManagers;
    use App\Models\Animal;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Table;
    use Illuminate\Support\Str;

    class AnimalResource extends Resource
    {
        protected static ?string $model = Animal::class;
        protected static ?string $navigationLabel = "Nombres Animales";
        protected static ?string $navigationIcon = 'heroicon-o-gift-top';
        protected static ?string $navigationGroup = 'Datos Genéricos';
        protected static ?int $navigationSort = 10;


        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    TextInput::make('name')
                        ->label('Nombre'),
                    Select::make('raza')
                        ->multiple()
                        ->relationship('raza', 'name')
                        ->searchable()
//                        ->options([
//                            Raza::all()->pluck('name', 'id')->toArray()
//                        ])
                        ->preload(),
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    TextColumn::make('name')->label('Nombre'),
                    Tables\Columns\TextColumn::make('raza')
                        ->label('Razas')
                        ->getStateUsing(fn($record) => collect($record->raza)
                            ->pluck('name')
                            ->map(fn($name) => Str::headline(str_replace('_', ' ', $name))))
                        ->colors([
                            'warning',
                        ])
                        ->badge(),
                ])
                ->defaultSort('name')
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
                'index' => Pages\ListAnimals::route('/'),
                'create' => Pages\CreateAnimal::route('/create'),
                //'edit' => Pages\EditAnimal::route('/{record}/edit'),
            ];
        }
    }
