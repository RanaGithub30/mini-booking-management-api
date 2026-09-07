<?php

namespace App\Traits;

use App\Models\User;

trait UserTraits
{
    public function checkUserExists($email){
        $user = User::whereEmail($email)->first();
        $isExists = false;

        if($user){
            $isExists = true;
        }

        return $isExists;
    }

    public function formatUserData($data){
        $data['password'] = bcrypt($data['password']);
        return $data;
    }
}