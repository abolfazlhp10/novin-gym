<?php

use Illuminate\Support\Facades\Log;

if (! function_exists('logError')) {

    function logError(string $log_level, string $message, $e): void
    {
        if (! in_array(strtolower($log_level), ['critical', 'info', 'emergency', 'alert', 'warning', 'debug', 'notice'])) {
            $log_level = 'error';
        }

        Log::$log_level($message, [
            "exception_message" => $e->getMessage(),
            "exception_file"    => $e->getFile(),
            "exception_line"    => $e->getLine(),
            "exception_trace"   => $e->getTraceAsString(),
        ]);

    }

}
