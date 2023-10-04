<?php

namespace App\Contracts\AddressVerification;

class AddressVerificationScenario
{
    public function __construct(
        public readonly AddressVerificationRequest $request,
        public readonly AddressVerificationResponse $response,
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