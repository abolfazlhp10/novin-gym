<?php

namespace App\Contracts;

interface SmsServiceInterface
{
    public function sendOtp(string $to, int $otp_code): bool;
}
