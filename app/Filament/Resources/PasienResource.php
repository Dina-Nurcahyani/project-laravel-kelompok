<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasienResource\Pages;
use App\Filament\Resources\PasienResource\RelationManagers;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')->required()->label('Nama')->prefixIcon('heroicon-o-user'),
                        TextInput::make('nik')->required()->label('NIK')->numeric()->prefixIcon('heroicon-o-identification'),
                        DatePicker::make('tanggal_lahir')->required()->label('Tanggal Lahir')->date()->prefixIcon('heroicon-o-calendar'),
                        Select::make('jenis_kelamin')->options([
                            'L' => 'Laki-laki',
                            'P' => 'Perempuan',
                        ])->required()->label('Jenis Kelamin')->prefixIcon('heroicon-o-user-circle'),
                        Textarea::make('alamat')->required()->label('Alamat'),
                        Select::make('status')->options([
                            'rawat_jalan' => 'Rawat Jalan',
                            'rawat_inap' => 'Rawat Inap',
                            'rujuk_keluar' => 'Rujuk Keluar',
                        ])->required()->label('Status')->prefixIcon('heroicon-o-chat-bubble-left'),
                        DatePicker::make('tanggal_masuk')->required()->label('Tanggal Masuk')->date()->prefixIcon('heroicon-o-calendar'),
                        FileUpload::make('gambar')->required()->label('Gambar')->image()->disk('public'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('nik')->label('NIK')->searchable()->sortable(),
                TextColumn::make('tanggal_lahir')->label('Tanggal Lahir')->searchable()->sortable(),
                TextColumn::make('jenis_kelamin')->label('Jenis Kelamin')->searchable()->sortable()->formatStateUsing(fn($state) => [
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                ][$state] ?? '-'),
                TextColumn::make('alamat')->label('Alamat')->searchable()->sortable(),
                TextColumn::make('status')->label('Status')->searchable()->sortable()->formatStateUsing(fn($state) => [
                    'rawat_inap' => 'Rawat Inap',
                    'rawat_jalan' => 'Rawat Jalan',
                    'rujuk_keluar' => 'Rujuk Keluar',
                ][$state] ?? '-'),
                TextColumn::make('tanggal_masuk')->label('Tanggal Masuk')->searchable()->sortable(),
                ImageColumn::make('gambar')->label('Gambar')->searchable()->sortable(),
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
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }
}
