<?php

namespace App\Classes;

class ApiResponse
{
    public function successResponse($message, $data, $status_code)
    {
        return response()->json(['message' => $message, 'data' => $data], $status_code);
    }

    public function errorResponse($message, $status_code)
    {
        return response()->json(['message' => $message], $status_code);
    }
}
