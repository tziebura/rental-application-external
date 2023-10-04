<?php

namespace App\Contracts\AddressVerification;

class AddressVerificationResponse
{
    public function __construct(
        public readonly string $status
    ) { }

    public function serialize(): string
    {
        return json_encode([
            'status' => $this->status,
        ]);
    }
}