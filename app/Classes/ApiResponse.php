<?php

namespace App\Classes;

class ApiResponse
{
    public function successResponse(string $message, $data, int $status_code)
    {
        return response()->json(['message' => $message, 'data' => $data], $status_code);
    }

    public function errorResponse(string $message, int $status_code)
    {
        return response()->json(['message' => $message], $status_code);
    }
}
