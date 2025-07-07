<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Home extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.home';

    protected static ?string $title = 'Beranda';
    protected static ?string $navigationLabel = 'Beranda';

    public $pasiens;

    public static function getSlug(): string
    {
        return '/';
    }

    public function mount(): void
    {
        $this->pasiens = \App\Models\Pasien::all();
    }
}
