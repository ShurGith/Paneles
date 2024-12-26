<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\RazaResource\Pages;
    use App\Filament\Resources\RazaResource\RelationManagers;
    use App\Models\Raza;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;
    use Illuminate\Support\Facades\DB;

    class RazaResource extends Resource
    {
        protected static ?string $model = Raza::class;

        protected static ?string $navigationLabel = "Razas Animales";
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
//                    Forms\Components\Select::make('animal')
//                        ->options(
//                            fn(Get $get): Collection => Animal::query()
//                                ->orderBy('name')
//                                ->pluck('name', 'id')
//                        )
//                        ->required(),
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    Tables\Columns\TextColumn::make('name')
                        ->label('Raza')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('animal')
                        ->exists(function ($record) {
                            return DB::table('animals')->where('id', $record->animal_id)
                                ->pluck('name');
                        })
                        ->label('Animal')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ])
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
                'create' => Pages\CreateRaza::route('/create'),
                'edit' => Pages\EditRaza::route('/{record}/edit'),
            ];
        }
    }
