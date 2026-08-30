<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ValidRealEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $apiKey = config('services.abstract_email.api_key');

        // If no API key configured, skip this check silently (don't break registration)
        if (empty($apiKey)) {
            return;
        }

        try {
            $response = Http::timeout(5)->get('https://emailvalidation.abstractapi.com/v1/', [
                'api_key' => $apiKey,
                'email'   => $value,
            ]);

            if (! $response->successful()) {
                // API failed/down — don't block registration, just skip check
                return;
            }

            $data = $response->json();

            // deliverability: DELIVERABLE, UNDELIVERABLE, RISKY, UNKNOWN
            $deliverability = $data['deliverability'] ?? 'UNKNOWN';

            // is_smtp_valid tells us if the mailbox itself responded as valid
            $smtpValid = $data['is_smtp_valid']['value'] ?? true;

            // is_disposable_email blocks temp/throwaway email services
            $isDisposable = $data['is_disposable_email']['value'] ?? false;

            if ($isDisposable) {
                $fail('Temporary or disposable email addresses are not allowed.');
                return;
            }

            if ($deliverability === 'UNDELIVERABLE' || $smtpValid === false) {
                $fail('This email address does not exist. Please use a real, active email.');
                return;
            }

        } catch (\Exception $e) {
            // Network/API error — log it, but don't block the user
            Log::warning('Email verification API failed: ' . $e->getMessage());
            return;
        }
    }
}