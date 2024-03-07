<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class UniqueViews extends ChartWidget
{


    protected static ?int $sort =3;
    protected static ?string $heading = 'Unique View';
    protected int | string | array $columnSpan = 1;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [10, 4, 14, 95, 80, 32, 45, 74, 40, 45, 77, 89],
                    'fill' => 'start',
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245,158,11,.2)',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
