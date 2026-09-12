<?php

namespace App\Traits;

trait CommonTraits{
    public function formatResponse($status, $message, 
    $data = null, $errors = null, $statusCode = 200){

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'errors' => $errors
        ], $statusCode);
        
    }
}