<?php

namespace App\Integration\Aci;

use App\Contract\PurchaseOneTimeInterface;
use App\Dto\PurchaseOneTimeRequestDto;
use App\Dto\PurchaseOneTimeResponseDto;
use App\Integration\Aci\Request\DebitPaymentRequest;

class AciService implements PurchaseOneTimeInterface
{
    public function __construct(
        private AciGateway $aciGateway,
    ) {
    }

    public function purchaseOneTime(PurchaseOneTimeRequestDto $purchaseOneTimeRequestDto): PurchaseOneTimeResponseDto
    {
        $debitPaymentResponse = $this->aciGateway->performDebitPayment(
            DebitPaymentRequest::createFromPurchaseOneTimeRequestDto($purchaseOneTimeRequestDto)
        );

        return new PurchaseOneTimeResponseDto(
            transactionId: $debitPaymentResponse->id,
            createdAt: new \DateTimeImmutable('now'),
            amount: (int) $debitPaymentResponse->amount,
            currency: $debitPaymentResponse->currency,
            cardBin: $debitPaymentResponse->card->bin,
        );
    }
}
