<?php

namespace App\Services;

use App\Traits\{UserTraits, GateAllowTrait, CommonTraits};
use App\Models\User;
use App\Events\RegisterEmailSendEvent;
use Illuminate\Support\Facades\Auth;
use App\Enums\{StatusEnums, StatusCodeEnums};

class UserService{
    use UserTraits, GateAllowTrait, CommonTraits;

    public function register($data){
        $userExists = $this->checkUserExists($data['email']);

        if($userExists){
            return $this->formatResponse(
                StatusEnums::ERROR, 
                StatusEnums::VALIDATION_FAILED, 
                null, 
                ['message' => StatusEnums::USER_EXISTS->value], 
                StatusCodeEnums::ERROR->value
            );
        }

        $formatUserData = $this->formatUserData($data);
        $createUser = User::create($formatUserData);

        /** Sending Email Using Event Listner */
        event(new RegisterEmailSendEvent($data['email']));

        return $this->formatResponse(
            StatusEnums::SUCCESS, 
            StatusEnums::USER_REGISTERED, 
            $createUser,
            null,
            StatusCodeEnums::USER_REGISTERED->value
        );
    }

    public function login($data){
        $email = $data['email'];
        $password = $data['password'];

        $userExists = $this->checkUserExists($data['email']);

        if(!$userExists){
            return $this->formatResponse(
                StatusEnums::ERROR, 
                StatusEnums::VALIDATION_FAILED, 
                null, 
                ['message' => StatusEnums::USER_NOT_FOUND->value], 
                StatusCodeEnums::UNAUTHORIZED->value
            );
        }

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->formatResponse(
                StatusEnums::SUCCESS, 
                StatusEnums::USER_LOGGED_IN, 
                [
                    'user' => $user,
                    'token' => $token
                ]
            );
        }
    }

    public function getUserDetails(){
        $user = Auth::user();

        return $this->formatResponse(
            StatusEnums::SUCCESS, 
            StatusEnums::USER_DETAILS_FETCHED, 
            $user
        );
    }

    public function updateUserDetails($data){
        $user = Auth::user();

        $formatUserData = $data;
        $password = $data['password'] ?? null;

        if($password){
            $data['password'] = bcrypt($password);
            $formatUserData = $this->formatUserData($data);
        }
        
        $user->update($formatUserData);

        return $this->formatResponse(
            StatusEnums::SUCCESS, 
            StatusEnums::USER_DETAILS_UPDATED, 
            $user
        );
    }
}