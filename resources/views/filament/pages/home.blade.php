    <x-filament-panels::page>
        <div class="text-2xl font-bold mb-4">Statistik</div>

        <div class="grid grid-cols-1 {{ auth()->user()->hasRole('admin') ? 'md:grid-cols-2' : '' }} gap-4 mb-6">
            <x-filament::card>
                <div class="text-center">
                    <div class="text-lg">Jumlah Pasien</div>
                    <div class="text-3xl font-bold text">{{ \App\Models\Pasien::count() }}</div>
                </div>
            </x-filament::card>

            @role('admin')
                <x-filament::card>
                    <div class="text-center">
                        <div class="text-lg">Jumlah Petugas</div>
                        <div class="text-3xl font-bold">{{ \App\Models\Petugas::count() }}</div>
                    </div>
                </x-filament::card>

            </div>

            <div class="grid grid-cols-1">
                @livewire(\App\Filament\Widgets\PasienChart::class)
            </div>
        @endrole
    </x-filament-panels::page>
