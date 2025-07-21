<?php

namespace App\Services;

use App\Contracts\SmsServiceInterface;

class TestingSmsService implements SmsServiceInterface
{
    public function send(string $to, string $message): bool
    {
        return true;
    }
}