<?php

namespace App\Services;

use App\Contracts\SmsServiceInterface;
use App\Exceptions\SmsSendingFailedException;
use Illuminate\Support\Facades\Http;

class FarazsmsService implements SmsServiceInterface
{
    public function __construct(
        private readonly string $base_url,
        private readonly string $username,
        private readonly string $password,
        private readonly string $from,
        private readonly string $pattern_code,
        private readonly int $timeout = 30,
        private readonly int $connect_timeout = 10,
    ) {}

    public function sendOtp(string $to, int $otp_code): bool
    {
        $queryData = [
            'username' => $this->username,
            'password' => $this->password,
            'from' => $this->from,
            'to' => $to,
            'input_data' => json_encode([
                'verification-code' => $otp_code,
            ]),
            'pattern_code' => $this->pattern_code,
        ];

        $queryString = http_build_query($queryData);
        $queryString = str_replace('%2B', '+', $queryString);

        $fullUrl = $this->base_url.'?'.$queryString;

        $response = Http::timeout($this->timeout)
            ->connectTimeout($this->connect_timeout)
            ->get($fullUrl);

        if ($response->successful()) {
            return true;
        }

        throw new SmsSendingFailedException($response);
    }
}
