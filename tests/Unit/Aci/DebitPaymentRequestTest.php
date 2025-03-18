<?php

namespace App\Tests\Unit\Aci;

use App\Dto\PurchaseOneTimeRequestDto;
use App\Integration\Aci\Request\CardRequest;
use App\Integration\Aci\Request\DebitPaymentRequest;

it('can be created from purchase one time request dto', function () {
    $expected = new DebitPaymentRequest(
        entityId: '8ac7a4c79394bdc801939736f17e063d',
        amount: 100,
        currency: 'EUR',
        paymentType: 'DB',
        card: new CardRequest(
            number: '4242424242424242',
            holder: 'Holder',
            expiryMonth: 12,
            expiryYear: 2023,
            cardCvv: '123',
        )
    );

    $actual = DebitPaymentRequest::createFromPurchaseOneTimeRequestDto(
        new PurchaseOneTimeRequestDto(
            amount: 100,
            currency: 'EUR',
            cardNumber: '4242424242424242',
            cardExpiryMonth: 12,
            cardExpiryYear: 2023,
            cardCvv: '123',
        )
    );

    expect($actual)->toEqual($expected);
});