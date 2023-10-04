<?php

namespace App\Contracts\Payment;

class PaymentScenario
{
    public function __construct(
        public readonly PaymentRequest $request,
        public readonly PaymentResponse $response,
    ) { }

    public function getRequestAsJson(): string
    {
        return $this->request->serialize();
    }

    public function getResponseAsJson(): string
    {
        return $this->response->serialize();
    }
}