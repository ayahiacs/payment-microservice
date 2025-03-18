<?php

namespace App\Tests\Unit\Shift4;

use App\Dto\PurchaseOneTimeRequestDto;
use App\Integration\Shift4\Factory\ChargeRequestFactory;
use Shift4\Request\ChargeRequest;

it('can be created from purchase one time request dto', function () {
    $expected = new ChargeRequest([
        'amount' => 100,
        'currency' => 'EUR',
        'card' => [
            'number' => '4242424242424242',
            'expMonth' => 12,
            'expYear' => 2023,
            'cvc' => '123',
        ]
    ]);

    $actual = ChargeRequestFactory::createFromPurchaseOneTimeRequestDto(
        new PurchaseOneTimeRequestDto(
            amount: 100,
            currency: 'EUR',
            cardNumber: '4242424242424242',
            cardExpiryMonth: 12,
            cardExpiryYear: 2023,
            cardCvv: '123',
        )
    );

    self::assertEquals($expected, $actual);
});
