<?php

namespace App\Contracts\AddressVerification;

class AddressVerificationRequest
{
    public function __construct(
        public readonly string $street,
        public readonly string $buildingNumber,
        public readonly string $postalCode,
        public readonly string $city,
        public readonly string $country,
    ) { }

    public function serialize(): string
    {
        $data = [
            'street' => $this->street,
            'building_number' => $this->buildingNumber,
            'postal_code' => $this->postalCode,
            'city' => $this->city,
            'country' => $this->country,
        ];

        return json_encode($data);
    }
}