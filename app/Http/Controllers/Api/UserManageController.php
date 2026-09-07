<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserManageController extends Controller
{

    public function __construct(UserService $userService){
            $this->userService = $userService; /**Service Container */
    }

    public function register(Request $request){
        return $this->userService->register($request->all());
    }
}