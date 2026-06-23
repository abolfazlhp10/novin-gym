<?php

namespace App\Services;

use App\Contracts\SmsServiceInterface;

class TestingSmsService implements SmsServiceInterface
{
    public function sendOtp(string $to, int $otp_code): bool
    {
        return true;
    }
}
