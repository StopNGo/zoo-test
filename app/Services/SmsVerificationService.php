<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class SmsVerificationService
{
    private const MOCK_VERIFICATION_CODE = '1234';

    public function sendVerificationCode(string $phone): string
    {
        Session::put('phone', $phone);

        return self::MOCK_VERIFICATION_CODE;
    }

    public function verify(string $phone, string $code): bool
    {
        return $code === self::MOCK_VERIFICATION_CODE;
    }

    public function getStoredPhone(): ?string
    {
        return Session::get('phone');
    }
}