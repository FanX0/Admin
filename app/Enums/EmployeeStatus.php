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

    public function getColor()
    {
        return match ($this){
            self::ACTIVE=> 'success',
            self::INACTIVE=> 'danger',
            self::ONLEAVE=> 'warning',
        };
    }

    public function getIcon()
    {
        return match ($this){
            self::ACTIVE=> 'heroicon-m-check-circle',
            self::INACTIVE=> 'heroicon-m-exclamation-circle',
            self::ONLEAVE=> 'heroicon-m-minus-circle',
        };
    }
   
}
