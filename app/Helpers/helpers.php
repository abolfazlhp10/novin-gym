<?php

use Hashids\Hashids;
use Illuminate\Support\Facades\Log;

if (! function_exists('logError')) {

    function logError(string $log_level, string $message, $e): void
    {
        if (! in_array(strtolower($log_level), ['critical', 'info', 'emergency', 'alert', 'warning', 'debug', 'notice'])) {
            $log_level = 'error';
        }

        Log::$log_level($message, [
            'exception_message' => $e->getMessage(),
            'exception_file' => $e->getFile(),
            'exception_line' => $e->getLine(),
            'exception_trace' => $e->getTraceAsString(),
        ]);

    }

}

if (! function_exists('hashid')) {

    function hashid($value)
    {
        $hashids = new Hashids(env('HASHIDS_MAIN_SALT'), env('HASHIDS_MAIN_LENGTH'));

        if (is_string($value)) {
            $decoded = $hashids->decode($value);

            if (empty($decoded)) {
                throw new InvalidArgumentException('Invalid Hashid string provided.');
            }

            return $decoded[0];
        } elseif (is_int($value)) {
            return $hashids->encode($value);
        }

        throw new InvalidArgumentException('The input should be either an integer or a string.');
    }

}
