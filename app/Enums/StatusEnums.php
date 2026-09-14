<?php

namespace App\Enums;

enum StatusEnums: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case VALIDATION_FAILED = 'Validation failed';
    case ERROR = 'error';
    case USER_DETAILS_UPDATED = 'User details updated successfully';
    case SUCCESS = 'success';
    case USER_DETAILS_FETCHED = 'User details fetched successfully';
    case USER_LOGGED_IN = 'User logged in successfully';
    case USER_LOGGED_OUT = 'User logged out successfully';
    case USER_NOT_FOUND = 'User not found';
    case USER_REGISTERED = 'User registered successfully';
    case NOT_AUTHORIZED = 'You are not authorized to update user details';
    case NAME_REQUIRED = 'Name is required';
    case NAME_STRING = 'Name must be a string';
    case NAME_MAX = 'Name must not exceed 255 characters';
    case EMAIL_REQUIRED = 'Email is required';
    case EMAIL_EMAIL = 'Email must be a valid email address';
    case EMAIL_MAX = 'Email must not exceed 255 characters';
    case PASSWORD_STRING = 'Password must be a string';
    case PASSWORD_MIN = 'Password must be at least 8 characters';
}