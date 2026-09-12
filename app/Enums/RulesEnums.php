<?php

namespace App\Enums;

enum RulesEnums: string
{
    case NAME_REQUIRED = 'Name is required';
    case EMAIL_REQUIRED = 'Email is required';
    case EMAIL_INVALID = 'Email must be a valid email address';
    case EMAIL_UNIQUE = 'Email already exists';
    case PASSWORD_MIN = 'Password must be at least 8 characters';
    case PASSWORD_STRING = 'Password must be a string';
    case PASSWORD_REQUIRED = 'Password is required';
}