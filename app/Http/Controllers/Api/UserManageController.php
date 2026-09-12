<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;

class UserManageController extends Controller
{

    public function __construct(UserService $userService){
            $this->userService = $userService; /**Service Container */
    }

    public function register(RegistrationRequest $request){
        return $this->userService->register($request->validated());
    }

    public function login(LoginRequest $request){
        return $this->userService->login($request->validated());
    }

    public function getUserDetails(){
        return $this->userService->getUserDetails();
    }
}