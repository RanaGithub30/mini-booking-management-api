<?php

namespace App\Services;

use App\Traits\UserTraits;
use App\Models\User;
use App\Events\RegisterEmailSendEvent;

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
}