<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\OwnerResource\Pages;
    use App\Filament\Resources\OwnerResource\RelationManagers;
    use App\Models\Owner;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Infolists\Components\ImageEntry;
    use Filament\Infolists\Components\TextEntry;
    use Filament\Infolists\Infolist;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;

    class OwnerResource extends Resource
    {
        protected static ?string $model = Owner::class;
        protected static ?string $navigationLabel = "Propietarios";
        protected static ?string $navigationIcon = 'heroicon-o-user-plus';
        protected static ?string $navigationGroup = 'Listado';
        protected static ?int $navigationSort = 2;

        //protected static ?string $activeNavigationIcon = 'heroicon-o-document-text';

        public static function getPluralLabel(): string
        {
            return 'Lista de Propietarios'; // Cambiar el título principal de la cabecera
        }

        public static function getLabel(): string
        {
            return 'Propietario'; // Cambiar el título singular si es necesario
        }

//        public static function getTitle(): string
//        {
//            return 'Mostrando'; // Cambia "View" por "Mostrando"
//        }


        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->maxLength(255)
                        ->required(),
                    Forms\Components\TextInput::make('phone'),
                    Forms\Components\TextInput::make('email'),

                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    Tables\Columns\ImageColumn::make('photo')
                        ->label('Foto')
                        ->circular()
                        ->defaultImageUrl(function ($record) {
                            return 'https://ui-avatars.com/api/?background=random&color=fff&name=' . urlencode($record->name);
                        }),
                    Tables\Columns\TextColumn::make('name')
                        ->label('Nombre')
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('phone')
                        ->label('Teléfono')
                        ->icon('heroicon-o-phone')
                        ->iconColor('secondary'),
                    Tables\Columns\TextColumn::make('email')
                        ->icon('heroicon-o-envelope')
                        ->iconColor('info')
                        ->copyable()
                        ->copyMessage('Email address copied')
                        ->copyMessageDuration(1500)
                        ->searchable(),
                    Tables\Columns\TextColumn::make('mascotas')
                        ->label('Mascotas')
                        ->getStateUsing(
                            fn($record) => collect($record->patients)
                                ->pluck('name')
                                ->map(fn($name) => $name)
                        )
                        ->colors([
                            'warning',
                        ])
                        ->badge(),
                ])
                ->filters([
                    //
                ])
                ->actions([
                    Tables\Actions\ViewAction::make()
                        ->slideOver()
                        ->color('info'),
                    Tables\Actions\EditAction::make()
                        ->slideOver(),
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ]),
                ]);
        }

        public static function infolist(Infolist $infolist): Infolist
        {
            return $infolist
                ->schema([
                    TextEntry::make('name')
                        ->label('Nombre'),
                    ImageEntry::make('photo')
                        ->label('Foto')
                        ->circular()
                        ->defaultImageUrl(function ($record) {
                            return 'https://ui-avatars.com/api/?background=random&color=fff&name=' . urlencode($record->name);
                        }),
                    TextEntry::make('phone')
                        ->label('Teléfono')
                        ->icon('heroicon-o-phone')
                        ->iconColor('secondary'),
                    TextEntry::make('email')
                        ->icon('heroicon-o-envelope')
                        ->iconColor('info')
                        ->copyable()
                        ->copyMessage('Email address copied')
                        ->copyMessageDuration(1500),
                    TextEntry::make('mascotas')
                        ->label('Mascotas')
                        ->getStateUsing(
                            fn($record) => collect($record->patients)
                                ->pluck('name')
                                ->map(fn($name) => $name)
                        )
                        ->colors([
                            'warning',
                        ])
                        ->badge(),
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
                'index' => Pages\ListOwners::route('/'),
                'create' => Pages\CreateOwner::route('/create'),
                //'edit' => Pages\EditOwner::route('/{record}/edit'),
                'view' => Pages\ViewOwner::route('/{record}'),
            ];
        }

    }
