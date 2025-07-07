<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PasienChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $data = \App\Models\Pasien::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                $label = ucfirst(str_replace('_', ' ', $item->status));
                return [$label => $item->total];
            });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pasien',
                    'data' => $data->values(),
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
