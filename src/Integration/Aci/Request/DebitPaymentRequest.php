<?php

namespace App\Integration\Aci\Request;

use App\Dto\PurchaseOneTimeRequestDto;

final class DebitPaymentRequest
{
    public function __construct(
        public string $entityId,
        public int $amount,
        public string $currency,
        public string $paymentType,
        public CardRequest $card
    ) {}

    public static function createFromPurchaseOneTimeRequestDto(PurchaseOneTimeRequestDto $dto): self
    {
        return new self(
            entityId: '8ac7a4c79394bdc801939736f17e063d',
            amount: $dto->amount,
            currency: $dto->currency,
            paymentType: 'DB',
            card: CardRequest::createFromPurchaseOneTimeRequestDto($dto)
        );
    }
}
