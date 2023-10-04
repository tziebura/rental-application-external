<?php

namespace App\Contracts\Payment;

class PaymentRequest
{
    public function __construct(
        public readonly string $senderId,
        public readonly string $recipientId,
        public readonly float $amount
    ) { }

    public function serialize(): string
    {
        $data = [
            'sender_id' => $this->senderId,
            'recipient_id' => $this->recipientId,
            'amount' => $this->amount,
        ];

        return json_encode($data);
    }
}