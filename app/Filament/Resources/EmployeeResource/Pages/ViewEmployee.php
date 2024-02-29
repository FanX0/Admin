<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;
    protected static ?string $title = 'Employee';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ActionGroup::make([
                Actions\EditAction::make('edit'),
                Actions\DeleteAction::make('delete')
            ])
            
        ];
    }

    public function getTitle(): string
    {
        return $this->record->name;
    }

}

   
