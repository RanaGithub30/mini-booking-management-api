<?php

namespace App\Gates;

use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;

class UserGates{
    public function __construct(){
        // Gate::define('update-post', [UserPolicy::class, 'update']);
    }
}