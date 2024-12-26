<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\PatientResource\Pages;
    use App\Filament\Resources\PatientResource\RelationManagers;
    use App\Models\Patient;
    use Filament\Forms\Components\DatePicker;
    use Filament\Forms\Components\FileUpload;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables\Actions\BulkActionGroup;
    use Filament\Tables\Actions\DeleteBulkAction;
    use Filament\Tables\Actions\EditAction;
    use Filament\Tables\Actions\ViewAction;
    use Filament\Tables\Columns\ImageColumn;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Table;
    use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

    class PatientResource extends Resource
    {
        protected static ?string $model = Patient::class;
        protected static ?string $navigationLabel = "Pacientes";
        protected static ?string $navigationGroup = 'Listado';
        protected static ?string $navigationIcon = 'heroicon-o-identification';
        protected static ?string $activeNavigationIcon = 'heroicon-o-document-text';
        protected static ?int $navigationSort = 2;

        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    TextInput::make('name')
                        ->label('Nombre')
                        ->required(),
                    Select::make('type')
                        ->label('Animal')
                        ->options([
                            Patient::all()->pluck('type', 'type')->toArray()
                        ])
                        ->searchable()
                        ->required(),
                    Select::make('raza')
                        ->label('Raza')
                        ->options([
                            Patient::pluck('raza', 'raza')->toArray()
                        ])
                        ->preload()
                        ->searchable(),
                    /*  ->createOptionForm([
                              Section::make('Create New Value')
                                  ->columns(1)
                                  ->schema([
                                      TextInput::make('raza')
                                          ->label('Nueva Raza')
                                          ->placeholder('Type a new value if none of the options are valid')
                                          ->helperText('If none of the options are valid, you can type a new value here.')
                                  ])
                          ]
                      ),*/

                    Select::make('gender')
                        ->label('Sexo')
                        ->options([
                            'Hembra' => 'Hembra',
                            'Macho' => 'Macho',
                        ])
                        ->searchable()
                        ->required(),
                    DatePicker::make('date_of_birth')
                        ->label('Fecha de Nacimiento')
                        ->default(now())
                        ->required()
                        ->maxDate(now()),
                    Select::make('owner_id')
                        ->label('Dueño')
                        ->relationship('owner', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->label('Email address')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            TextInput::make('phone')
                                ->label('Phone number')
                                ->tel()
                                ->required(),
                            FileUpload::make('photo')
                                ->getUploadedFileNameForStorageUsing(
                                    fn(TemporaryUploadedFile $file): string => (string)str($file->getClientOriginalName())
                                        ->prepend(time() . '-'),
                                )
                                ->directory('images/owners')
                                ->avatar()
                                ->imageEditor()
                                ->circleCropper(),
                        ])
                        ->required(),
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->label('Veterinario')
                        ->placeholder('Vete que tome el paciente')
                        ->searchable()
                        ->preload()
                        ->required(),
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    ImageColumn::make('photo')
                        ->label('Foto')
                        ->circular()
                        ->defaultImageUrl(function ($record) {
                            return 'https://ui-avatars.com/api/?background=random&color=fff&name=' . urlencode($record->name);
                        }),
                    TextColumn::make('name')->label('Nombre'),
                    TextColumn::make('gender')->label('Sexo'),
                    TextColumn::make('raza.name')->label('Raza')
                        ->badge(),
                    //  ->description(),
                    // TextColumn::make('type')->label('Animal'),
                    TextColumn::make('date_of_birth')
                        ->label('Año Nacimiento')
                        ->date('Y'),
                    TextColumn::make('owner.name')
                        ->label('Propietario')
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('user.name')->label('Veterinario'),
                ])
                ->filters([
                    //
                ])
                ->actions([
                    ViewAction::make()
                        ->color('info')
                        ->slideOver(),
                    EditAction::make()
                        /*   ->color('secondary')
                           ->icon('heroicon-s-pencil-square')*/
                        ->slideover(),
                ])
                ->bulkActions([
                    BulkActionGroup::make([
                        DeleteBulkAction::make(),
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
                'index' => Pages\ListPatients::route('/'),
                'create' => Pages\CreatePatient::route('/create'),
                //'edit' => Pages\EditPatient::route('/{record}/edit'),
            ];
        }
    }
