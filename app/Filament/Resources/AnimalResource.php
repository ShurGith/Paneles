<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\AnimalResource\Pages;
    use App\Filament\Resources\AnimalResource\RelationManagers;
    use App\Models\Animal;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Table;

    class AnimalResource extends Resource
    {
        protected static ?string $model = Animal::class;
        protected static ?string $navigationLabel = "Nombres Animales";
        protected static ?string $navigationIcon = 'icon-elephant_icon';
        protected static ?string $activeNavigationIcon = 'icon-elephant_activo';
        protected static ?string $navigationGroup = 'Datos Genéricos';
        protected static ?int $navigationSort = 10;


        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    TextInput::make('name')
                        ->label('Animal')
                        ->helperText('Es el tipo de animal Ejemplos: Perro, Gato ')
                        //   ->hint('Usaremos este  correo para enviarte notificaciones.')
                        ->suffixIcon('heroicon-m-globe-alt')
                        ->suffixIconColor('secondary'),
                    /*                    Select::make('razas')
                                            ->multiple()
                                            ->relationship('raza', 'name')
                                            ->searchable()
                                            ->preload(),*/
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    TextColumn::make('name')
                        ->label('Nombre')
                        ->sortable()
                        //   ->colorlabel('info')
                        ->searchable(),
                    TextColumn::make('raza.name')
                        ->label('Razas')
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
                ->emptyStateActions([
                    Tables\Actions\CreateAction::make(),
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
                //'create' => Pages\CreateAnimal::route('/create')
                //'edit' => Pages\EditAnimal::route('/{record}/edit'),
            ];
        }
    }
