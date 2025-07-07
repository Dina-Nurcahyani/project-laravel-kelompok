<?php

namespace App\Filament\Resources\PasienResource\Pages;

use App\Filament\Resources\PasienResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPasien extends EditRecord
{
    protected static string $resource = PasienResource::class;

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
