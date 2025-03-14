<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class PurchaseOneTimeRequestDto
{
    public function __construct(
        #[Assert\NotBlank()]
        #[Assert\Positive()]
        public int $amount,

        #[Assert\NotBlank()]
        #[Assert\Length(max: 3)]
        #[Assert\Regex(pattern: '/^[A-Z]{3}$/')]
        public string $currency,

        #[Assert\NotBlank()]
        #[Assert\Length(exactly: 16)]
        #[Assert\Regex(pattern: '/^[0-9]{16}$/')]
        public string $cardNumber,

        #[Assert\NotBlank()]
        #[Assert\GreaterThanOrEqual(2024)]
        public int $cardExpiryYear,

        #[Assert\NotBlank()]
        #[Assert\GreaterThanOrEqual(1)]
        #[Assert\LessThanOrEqual(12)]
        public int $cardExpiryMonth,

        #[Assert\NotBlank()]
        #[Assert\Length(exactly: 3)]
        #[Assert\Regex(pattern: '/^[0-9]{3}$/')]
        public string $cardCvv
    ) {}
}
