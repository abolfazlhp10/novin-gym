<?php

namespace App\Services;

use App\Contracts\SmsServiceInterface;

class FarazsmsService implements SmsServiceInterface
{
    public function send(string $to, string $message): bool
    {
        return true;
    }
}