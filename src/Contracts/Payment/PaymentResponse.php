<?php

namespace App\Contracts\Payment;

class PaymentResponse
{
    public function __construct(
        public readonly string $status,
    ) { }

    public static function success(): self
    {
        return new self('SUCCESS');
    }

    public static function notEnoughMoney(): self
    {
        return new self('NOT_ENOUGH_RESOURCES');
    }

    public function serialize(): string
    {
        return json_encode([
            'status' => $this->status,
        ]);
    }
}