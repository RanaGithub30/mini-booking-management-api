<?php

namespace App\Services;

use App\Traits\UserTraits;
use App\Models\User;
use App\Events\RegisterEmailSendEvent;
use Illuminate\Support\Facades\Auth;

class UserService{
    use UserTraits;

    public function register($data){
        $userExists = $this->checkUserExists($data['email']);

        if($userExists){
            return response()
            ->json(
                [
                    'message' => 'User already exists'
                ], 
                400);
        }

        $formatUserData = $this->formatUserData($data);
        $createUser = User::create($formatUserData);

        /** Sending Email Using Event Listner */
        event(new RegisterEmailSendEvent($data['email']));

        return response()->json(
            [
                'message' => 'User created successfully',
                'data' => $createUser
            ],  
            200
        );
    }

    public function login($data){
        $email = $data['email'];
        $password = $data['password'];

        $userExists = $this->checkUserExists($data['email']);

        if(!$userExists){
            return response()
            ->json(
                [
                    'message' => 'User does not exists'
                ], 
            400);
        }

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(
                [
                    'message' => 'User logged in successfully',
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ],
                200
            );
        }
    }

    public function getUserDetails(){
        $user = Auth::user();

        return response()->json(
            [
                'message' => 'User details fetched successfully',
                'data' => $user
            ],
            200
        );
    }
}