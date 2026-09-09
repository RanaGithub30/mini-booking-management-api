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

    public function login(Request $request){
        return $this->userService->login($request->all());
    }

    public function getUserDetails(){
        return $this->userService->getUserDetails();
    }
}