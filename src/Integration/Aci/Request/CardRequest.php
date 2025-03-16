<?php

namespace App\Integration\Aci\Request;

use App\Dto\PurchaseOneTimeRequestDto;

final class CardRequest
{
    public function __construct(
        public string $number,
        public string $holder,
        public int $expiryMonth,
        public int $expiryYear,
        public string $cardCvv
    ) {}

    public static function createFromPurchaseOneTimeRequestDto(PurchaseOneTimeRequestDto $dto): self
    {
        return new self(
            number: $dto->cardNumber,
            holder: 'Holder',
            expiryMonth: $dto->cardExpiryMonth,
            expiryYear: $dto->cardExpiryYear,
            cardCvv: $dto->cardCvv
        );
    }
}
