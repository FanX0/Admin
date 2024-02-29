<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LeaveRequestType: string implements HasLabel
{
    case ANNUAL = 'Annual';
    case SICK = 'Sick';
    case MATERNITY = 'maternity';
    case PATERNITY = 'paternity';

    public function getLabel(): ?string
    {
        return str($this->value)->title();
    }
}
