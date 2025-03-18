<?php

namespace App\Integration\Shift4;

use App\Contract\PurchaseOneTimeInterface;
use App\Dto\PurchaseOneTimeRequestDto;
use App\Dto\PurchaseOneTimeResponseDto;
use App\Exception\PurchaseOneTimeException;
use App\Integration\Shift4\Factory\ChargeRequestFactory;
use Shift4\Exception\Shift4Exception;
use Shift4\Request\CardRequest;
use Shift4\Request\ChargeRequest;
use Shift4\Response\Charge;
use Shift4\Shift4Gateway;

class Shift4Service implements PurchaseOneTimeInterface
{
    public function __construct(
        private Shift4Gateway $shift4Gateway,
        private ChargeRequestFactory $chargeRequestFactory
    ) {
    }

    public function purchaseOneTime(PurchaseOneTimeRequestDto $purchaseOneTimeRequestDto): PurchaseOneTimeResponseDto
    {
        $chargeRequest = $this->chargeRequestFactory->createFromPurchaseOneTimeRequestDto($purchaseOneTimeRequestDto);

        try {
            /** @var Charge $charge */
            $charge = $this->shift4Gateway->createCharge($chargeRequest);
        } catch (Shift4Exception $e) {
            throw new PurchaseOneTimeException("Shift4 exeption. Code: {$e->getCode()} Type: {$e->getType()} Message: {$e->getMessage()}");
        }

        return new PurchaseOneTimeResponseDto(
            transactionId: $charge->getId(),
            createdAt: new \DateTimeImmutable('now'),
            amount: $charge->getAmount(),
            currency: $charge->getCurrency(),
            cardBin: $charge->getCard()->getFirst6(),
        );
    }
}
