<?php

namespace App\Enums;

enum StatusCodeEnums: int
{
    case SUCCESS = 200;
    case ERROR = 400;
    case VALIDATION_FAILED = 422;
    case USER_EXISTS = 409;
    case USER_REGISTERED = 201;
    case USER_NOT_FOUND = 404;
    case UNAUTHORIZED = 401;
}