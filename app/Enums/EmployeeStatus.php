<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;


enum EmployeeStatus: string implements HasLabel

{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case ONLEAVE = 'on_leave';


    public function getLabel(): ?string
    {
        return str(str($this->value)->replace('_', ' '))->title();
    }
   
}
