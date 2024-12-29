<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\PatientResource\Pages;
    use App\Filament\Resources\PatientResource\RelationManagers;
    use App\Models\Patient;
    use App\Models\Raza;
    use Filament\Forms\Components\DatePicker;
    use Filament\Forms\Components\FileUpload;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Forms\Get;
    use Filament\Forms\Set;
    use Filament\Infolists\Components\ImageEntry;
    use Filament\Infolists\Components\RepeatableEntry;
    use Filament\Infolists\Components\Section;
    use Filament\Infolists\Components\TextEntry;
    use Filament\Infolists\Infolist;
    use Filament\Resources\Resource;
    use Filament\Support\Enums\FontWeight;
    use Filament\Tables\Actions\BulkActionGroup;
    use Filament\Tables\Actions\DeleteAction;
    use Filament\Tables\Actions\DeleteBulkAction;
    use Filament\Tables\Actions\EditAction;
    use Filament\Tables\Actions\ViewAction;
    use Filament\Tables\Columns\ImageColumn;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Table;
    use Illuminate\Support\Collection;
    use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

    class PatientResource extends Resource
    {
        protected static ?string $model = Patient::class;
        protected static ?string $navigationLabel = "Pacientes";
        protected static ?string $navigationGroup = 'Listado';
        protected static ?string $navigationIcon = 'icon-dog';//'heroicon-o-identification';
        protected static ?string $activeNavigationIcon = 'icon-dog_2';//'heroicon-o-document-text';
        protected static ?int $navigationSort = 2;


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
                    TextColumn::make('owner.name')
                        ->label('Propietario')
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('treatment')
                        ->label('Consultas')
                        ->getStateUsing(
                            fn($record) => collect($record->treatment)
                                ->count()
                        )
                ])
                ->defaultSort('name')
                ->filters([
                    //
                ])
                ->actions([
                    DeleteAction::make()
                        ->color('danger')
                        ->button()
                        ->icon('heroicon-s-trash'),
                    ViewAction::make()
                        ->color('info')
                        ->button()
                        ->icon('heroicon-s-pencil'),
                    //    ->slideOver(),
                    EditAction::make()
                        ->color('success')
                        ->button()
                        ->slideover(),
                ])
                ->bulkActions([
                    BulkActionGroup::make([
                        DeleteBulkAction::make(),
                    ]),
                ]);
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
                    Select::make('raza_id')
                        ->label('Raza')
                        ->options(
                            fn(Get $get): Collection => Raza::query()
                                ->where('animal_id', $get('animal_id'))
                                ->pluck('name', 'id')
                        )
                        ->preload()
                        ->searchable()
                        ->live(),
                    Select::make('animal_id')
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
                ]);
        }

        public static function infolist(Infolist $infolist): Infolist
        {
            return $infolist
                ->schema([
                    Section::make()
                        /*           ->description((function ($record) {
                                       return 'Paciente creado el ' . $record->created_at->format('l d F Y');
                                   }))*/
                        ->columns([
                            'default' => 4,
                        ])
                        ->schema([
                            Section::make()
                                // ->description(fn($record) => $record->raza->name)
                                ->columnSpan(1)
                                ->schema([
                                    ImageEntry::make('photo')
                                        ->label('')
                                        ->circular()
                                        ->defaultImageUrl(function ($record) {
                                            return 'https://ui-avatars.com/api/?background=random&color=fff&name=' . urlencode($record->name);
                                        }),
                                    TextEntry::make('name')
                                        ->label('')
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->weight(FontWeight::Bold)
                                        ->html(),
                                    TextEntry::make('raza.name')
                                        ->label('')
                                        ->getStateUsing(function($record) {
                                            return $record->animal->name.' - '.$record->raza->name .' <br>'.$record->gender;
                                        })
                                    ->html(),
                                    //    ->getStateUsing(fn($record) => $record->gender),
                                    TextEntry::make('owner.name')
                                        ->label('Propietario'),
                                    TextEntry::make('owner.phone')
                                        ->icon('heroicon-o-phone')
                                        ->label(''),
                                    TextEntry::make('owner.email')
                                        ->icon('heroicon-o-envelope')
                                        ->label(''),
                                ]),
                            RepeatableEntry::make('treatment')
                                ->label('Consultas')
                                ->columnSpan(3)
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('price')
                                        ->money('EUR', divideBy: 100)
                                        ->prefix('Total: ')
                                        ->color('primary'),
                                    TextEntry::make('created_at')
                                        ->getStateUsing((function ($record) {
                                            return ucfirst($record->created_at->format('l d F Y'));
                                        }))
                                        ->label('Fecha de consulta'),
                                    TextEntry::make('description')
                                        ->columnSpan(2)
                                        ->html(),
                                    TextEntry::make('notes')
                                        ->columnSpan(2)
                                        ->html(),
                                ]),
                        ])

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
                'view' => Pages\ViewPatient::route('/{record}'),
                //'edit' => Pages\EditPatient::route('/{record}/edit'),
            ];
        }
    }
