<?php

namespace App\Filament\Widgets;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Stats extends BaseWidget
{
    
    protected function getStats(): array
    {
        return [
            Stat::make('Employess', Employee::count())
               ->icon('heroicon-o-user-group')
               ->description('Total number of employess'),
                Stat::make('Departments', Department::count())
            ->icon('heroicon-o-home-modern')
            ->description('Total number of departments'),
                Stat::make('Positions', Position::count())
            ->icon('heroicon-o-hashtag')
            ->description('Total number of positions'),
        ];
    }
}
