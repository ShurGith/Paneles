<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\UserResource\Pages;
    use App\Filament\Resources\UserResource\RelationManagers;
    use App\Models\User;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;
    use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

    class UserResource extends Resource
    {
        protected static ?string $model = User::class;
        protected static ?string $navigationLabel = "Veterinarios";

        protected static ?string $navigationIcon = 'icon-medico';//'heroicon-o-identification';
        protected static ?string $activeNavigationIcon = 'icon-medico_notas';//'heroicon-o-document-text';
        protected static ?string $navigationGroup = 'Listado';
        //protected static ?string $activeNavigationIcon = 'heroicon-o-document-text';
        protected static ?int $navigationSort = 1;

        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->hiddenOn('edit')
                        ->required(),
                    Forms\Components\TextInput::make('phone')
                        ->tel(),
                    Forms\Components\FileUpload::make('photo')
                        ->getUploadedFileNameForStorageUsing(
                            fn(TemporaryUploadedFile $file): string => (string)str($file->getClientOriginalName())
                                ->prepend(time() . '-'),
                        )
                        ->directory('images/veterinarios')
                        ->avatar()
                        ->imageEditor()
                        ->circleCropper(),
                    Forms\Components\Toggle::make('es_activo')
                        ->label('En Activo')
                        ->default(true)
                        ->onColor('success')
                        ->offColor('danger')
                        ->onIcon('heroicon-m-bolt')
                        ->offIcon('heroicon-m-user'),
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
                    //Tables\Columns\TextColumn::make('photo'),
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
                    Tables\Columns\IconColumn::make('es_activo')
                        ->boolean()
                        ->label('Activo'),
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
                'index' => Pages\ListUsers::route('/'),
                'create' => Pages\CreateUser::route('/create'),
                //'edit' => Pages\EditUser::route('/{record}/edit'),
            ];
        }
    }
