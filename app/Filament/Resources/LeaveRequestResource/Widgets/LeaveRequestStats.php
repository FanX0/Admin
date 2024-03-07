<?php

namespace App\Filament\Resources\LeaveRequestResource\Widgets;

use App\Enums\LeaveRequestStatus;
use App\Models\LeaveRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeaveRequestStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Approve ', LeaveRequest::where('status',LeaveRequestStatus::APPROVED)->count())
                ->description('The number of approve leave request.')
                ->icon('heroicon-o-minus-circle')
                ->chart([1,4,6,7,8])
                ->color('success'),
            Stat::make('Pending', LeaveRequest::where('status',LeaveRequestStatus::PENDING)->count())
                ->description('The number of pending leave request.')
                ->icon('heroicon-o-check-circle')
                ->chart([1,4,6,7,8])
                ->color('warning'),
            Stat::make('Rejected', LeaveRequest::where('status',LeaveRequestStatus::REJECTED)->count())
                ->description('The number of rejected leave request.')
                ->icon('heroicon-o-exclamation-circle')
                ->chart([1,4,6,7,8])
                ->color('danger'),
        ];
    }
}
