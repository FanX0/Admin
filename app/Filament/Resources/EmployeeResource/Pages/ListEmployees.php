<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Employee;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array 
    {
        return [
            'all'=> Tab::make('All')
                ->badge(Employee::count()),
            'active'=> Tab::make('Active')
                ->badge(Employee::where('status','active')->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'active')),
            'inactive'=> Tab::make('In Active')
                ->badge(Employee::where('status','inactive')->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'inactive')),
            'on_leave'=> Tab::make('On Leave')
                ->badge(Employee::where('status','on_leave')->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'on_leave')),
        ];
    }
}
