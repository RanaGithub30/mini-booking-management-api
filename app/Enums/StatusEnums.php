<?php

namespace App\Enums;

enum StatusEnums: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case VALIDATION_FAILED = 'Validation failed';
    case ERROR = 'error';
}