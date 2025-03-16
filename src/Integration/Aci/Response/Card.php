<?php

namespace App\Integration\Aci\Response;

class Card
{
    public function __construct(
        public string $bin,
        public string $last4Digits,
        public string $holder,
        public string $expiryMonth,
        public string $expiryYear,
    ) {
    }
}
