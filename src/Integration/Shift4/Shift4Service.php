<?php

namespace App\Integration\Shift4;

use App\Contract\PurchaseOneTimeInterface;
use App\Dto\PurchaseOneTimeRequestDto;
use App\Dto\PurchaseOneTimeResponseDto;
use Shift4\Shift4Gateway;
use Shift4\Exception\Shift4Exception;
use Shift4\Request\CardRequest;
use Shift4\Request\ChargeRequest;
use Shift4\Response\Charge;

class Shift4Service implements PurchaseOneTimeInterface
{
    // TODO: pass from config
    public function __construct(
        private $shift4Gateway = new Shift4Gateway('sk_test_kZZnbRyw5faOdTCrO1rXQopJ')
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
            // TODO: Handle error response - see https://dev.shift4.com/docs/api#error-object
            $errorType = $e->getType();
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            // TODO: Retry the request if the error is server error, if failed 3 times add it to failed jobs.
            dd($errorMessage);
        } finally {
            // TODO: Log everything anyways.
        }

        return new PurchaseOneTimeResponseDto(
            transactionId: $charge->getId(),
            createdAt: $charge->getCreated(),
            amount: $charge->getAmount(),
            currency: $charge->getCurrency(),
            cardBin: $charge->getCard()->getFirst6(),
        );
    }
}
