<?php

namespace App\Integration\Shift4\Factory;

use Shift4\Request\CardRequest;
use Shift4\Request\ChargeRequest;
use App\Dto\PurchaseOneTimeRequestDto;

class ChargeRequestFactory
{
    public static function createFromPurchaseOneTimeRequestDto(PurchaseOneTimeRequestDto $purchaseOneTimeRequestDto): ChargeRequest
    {
        return (new ChargeRequest())
            ->amount($purchaseOneTimeRequestDto->amount)
            ->currency($purchaseOneTimeRequestDto->currency)
            ->card(
                (new CardRequest())
                ->number($purchaseOneTimeRequestDto->cardNumber)
                ->expMonth($purchaseOneTimeRequestDto->cardExpiryMonth)
                ->expYear($purchaseOneTimeRequestDto->cardExpiryYear)
                ->cvc($purchaseOneTimeRequestDto->cardCvv)
            );
    }
}

