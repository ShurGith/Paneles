<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\OwnerResource\Pages;
    use App\Filament\Resources\OwnerResource\RelationManagers;
    use App\Models\Owner;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;

    class OwnerResource extends Resource
    {
        protected static ?string $model = Owner::class;
        protected static ?string $navigationLabel = "Propietarios";

        protected static ?string $navigationIcon = 'heroicon-o-user-plus';
        protected static ?string $navigationGroup = 'Listado';
        //protected static ?string $activeNavigationIcon = 'heroicon-o-document-text';
        protected static ?int $navigationSort = 2;

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
                'index' => Pages\ListOwners::route('/'),
                'create' => Pages\CreateOwner::route('/create'),
                'edit' => Pages\EditOwner::route('/{record}/edit'),
            ];
        }
    }
