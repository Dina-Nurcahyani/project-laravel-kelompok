<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetugasResource\Pages;
use App\Filament\Resources\PetugasResource\RelationManagers;
use App\Models\Petugas;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetugasResource extends Resource
{
    protected static ?string $model = Petugas::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Petugas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')->required()->label('Nama')->prefixIcon('heroicon-o-user'),
                    Select::make('jabatan')->options([
                        'Psikiater' => 'Dokter Spesialis Jiwa',
                        'Psikolog' => 'Psikolog',
                        'Perawat' => 'Perawat',
                        'Admin' => 'Petugas Administrasi',
                    ])->required()->label('Jabatan')->prefixIcon('heroicon-o-user-circle'),
                    TextInput::make('no_telp')->required()->label('Nomor Telepon')->numeric()->prefixIcon('heroicon-o-phone')->prefix('+62'),
                    FileUpload::make('foto')->required()->label('Foto')->image()->disk('public'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('jabatan')->label('Jabatan')->searchable()->sortable(),
                TextColumn::make('no_telp')->label('Nomor Telepon')->searchable()->sortable(),
                ImageColumn::make('foto')->label('Foto')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPetugas::route('/'),
            'create' => Pages\CreatePetugas::route('/create'),
            'edit' => Pages\EditPetugas::route('/{record}/edit'),
        ];
    }
}
