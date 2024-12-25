<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'cat' => 'Cat',
                        'dog' => 'Dog',
                        'rabbit' => 'Rabbit',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('color')
                    ->required(),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->preload()->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone number')
                            ->tel()
                            ->required(),
                        Forms\Components\FileUpload::make('photo')
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
                Forms\Components\Select::make('user_id')
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
                Tables\Columns\ImageColumn::make('photo')
                ->circular()
                ->defaultImageUrl(function ($record) {
                    return 'https://ui-avatars.com/api/?background=random&color=fff&name=' . urlencode($record->name);
                }),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth'),
                Tables\Columns\TextColumn::make('owner.name'),
                Tables\Columns\TextColumn::make('user.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->color('secondary')
                    ->icon('heroicon-s-pencil-square')
                    ->slideover(),
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
