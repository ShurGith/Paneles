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
                        ->required(),
                    Forms\Components\TextInput::make('animal_id')
                        ->required()
                        ->numeric(),
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    Tables\Columns\TextColumn::make('name')
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
