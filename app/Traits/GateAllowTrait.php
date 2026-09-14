<?php

namespace App\Traits;

use Illuminate\Support\Facades\Gate;

trait GateAllowTrait{
    public function GateNotAllow($gate = "", 
    $user_details = null, $message = "", $statusCode = 200){
        if(! Gate::allows($gate, $user_details)){
            return response()->json(
                [
                    'message' => $message
                ],
                $statusCode
            );
        }
    }
}