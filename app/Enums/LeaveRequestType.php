<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LeaveRequestType: string implements HasLabel

{
    case ANNUAL = 'pending';
    case SICK = 'approved';
    CASE MATERNITY = 'maternity';
    case PATERNITY = 'paternity';

    public function getLabel(): ?string
    {
        return str($this->value)->title();
    }
}