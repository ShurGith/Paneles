<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\PatientResource\Pages;
    use App\Filament\Resources\PatientResource\RelationManagers;
    use App\Models\Animal_Raza;
    use App\Models\Patient;
    use App\Models\Raza;
    use Filament\Forms\Components\DatePicker;
    use Filament\Forms\Components\FileUpload;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Forms\Get;
    use Filament\Forms\Set;
    use Filament\Resources\Resource;
    use Filament\Tables\Actions\BulkActionGroup;
    use Filament\Tables\Actions\DeleteBulkAction;
    use Filament\Tables\Actions\EditAction;
    use Filament\Tables\Actions\ViewAction;
    use Filament\Tables\Columns\ImageColumn;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Table;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\DB;
    use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

    class PatientResource extends Resource
    {
        protected static ?string $model = Patient::class;
        protected static ?string $navigationLabel = "Pacientes";
        protected static ?string $navigationGroup = 'Listado';
        protected static ?string $navigationIcon = 'heroicon-o-identification';
        protected static ?string $activeNavigationIcon = 'heroicon-o-document-text';
        protected static ?int $navigationSort = 2;

            public static function getAnimales($id): array
            {
                $razas =
                DB::table('animal_raza')
                ->where('animal_id', $id)
                ->pluck('raza_id');

                dd($razas);
                $names = [];
                foreach ($razas as $raza) {
                    $names[] = DB::table('razas')
                        ->where('id', $raza->raza_id)
                        ->value('name');
                }

                return $names;
            }
        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    TextInput::make('name')
                        ->label('Nombre')
                        ->required(),
                    Select::make('gender')
                        ->label('Sexo')
                        ->options([
                            Patient::all()->pluck('gender', 'gender')->toArray()
                        ])
                        ->searchable()
                        ->required(),
                    Select::make('razas')
                        ->multiple()
                      //  ->relationship('raza', 'name')
                        ->searchable()
                        ->live()
                        ->options(
                            fn(Get $get): Collection => Raza::query()
                                ->where('id', $get('raza_id'))
                                ->pluck('name', 'id')
                           // self::getAnimales(fn($record) => $record->animal_id)
                        ),
                    Select::make('animal')
                        ->relationship('animal', 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(fn(Set $set) => $set('razas', null)),

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
                    TextColumn::make('animal.name')->label('Animal'),
                    TextColumn::make('gender')->label('Sexo'),
                    TextColumn::make('raza.name')->label('Raza')
                        ->badge(),
                    //  ->description(),
                    // TextColumn::make('type')->label('Animal'),
                  /*  TextColumn::make('date_of_birth')
                        ->label('Año Nacimiento')
                        ->date('Y'),*/
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
