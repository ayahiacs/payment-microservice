<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class PurchaseOneTimeResponseDto
{
    public function __construct(
        public string $transactionId,
        public string $createdAt,
        public int $amount,
        public string $currency,
        public string $cardBin,
    ) {}
}
