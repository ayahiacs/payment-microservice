<?php

namespace App\Integration\Shift4;

use App\Contract\PurchaseOneTimeInterface;
use App\Dto\PurchaseOneTimeRequestDto;
use App\Dto\PurchaseOneTimeResponseDto;
use App\Exception\PurchaseOneTimeException;
use DateTimeImmutable;
use Psr\Log\LoggerInterface;
use Shift4\Shift4Gateway;
use Shift4\Exception\Shift4Exception;
use Shift4\Request\CardRequest;
use Shift4\Request\ChargeRequest;
use Shift4\Response\Charge;

class Shift4Service implements PurchaseOneTimeInterface
{
    public function __construct(
        private Shift4Gateway $shift4Gateway,
        private LoggerInterface $logger
    ) {
    }


    public function purchaseOneTime(PurchaseOneTimeRequestDto $purchaseOneTimeRequestDto): PurchaseOneTimeResponseDto
    {
        $chargeRequest = (new ChargeRequest())
            ->amount($purchaseOneTimeRequestDto->amount)
            ->currency($purchaseOneTimeRequestDto->currency)
            ->card((new CardRequest())
                ->number($purchaseOneTimeRequestDto->cardNumber)
                ->expMonth($purchaseOneTimeRequestDto->cardExpiryMonth)
                ->expYear($purchaseOneTimeRequestDto->cardExpiryYear)
                ->cvc($purchaseOneTimeRequestDto->cardCvv)
            );

        try {
            /** @var Charge $charge */
            $charge = $this->shift4Gateway->createCharge($chargeRequest);
        } catch (Shift4Exception $e) {
            // reference: see https://dev.shift4.com/docs/api#error-object
            throw new PurchaseOneTimeException("Shift4 exeption. Code: {$e->getCode()} Type: {$e->getType()} Message: {$e->getMessage()}");
        } finally {
            // TODO: save request response logs in DB anyways.
        }

        return new PurchaseOneTimeResponseDto(
            transactionId: $charge->getId(),
            createdAt: new DateTimeImmutable('now'),
            amount: $charge->getAmount(),
            currency: $charge->getCurrency(),
            cardBin: $charge->getCard()->getFirst6(),
        );
    }
}
