<?php

namespace App\Integration\Aci\Request;

use App\Dto\PurchaseOneTimeRequestDto;

final class CardRequest
{
    public function __construct(
        public $number,
        public $holder,
        public $expiryMonth,
        public $expiryYear,
        public $cardCvv
    ) {}

    public static function createFromPurchaseOneTimeRequestDto(PurchaseOneTimeRequestDto $dto)
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
