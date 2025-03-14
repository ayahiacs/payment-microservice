<?php

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

pest()->extend(ApiTestCase::class);

it('purchases one time using aci successfully', function () {
    $client = static::createClient();

    $client->request('POST', '/purchase-one-time/aci', [
        'json' => [
            'amount' => 1,
            'currency' => 'USD',
            'cardNumber' => '4200000000000000',
            'cardExpiryYear' => 2025,
            'cardExpiryMonth' => 12,
            'cardCvv' => '999',
        ]
    ]);

    $response = $client->getResponse();

    expect($response->getStatusCode())->toBe(200);
});

it('purchases one time using shift4 successfully', function () {
    $client = static::createClient();

    $client->request('POST', '/purchase-one-time/shift4', [
        'json' => [
            'amount' => 1,
            'currency' => 'USD',
            'cardNumber' => '4242424242424242',
            'cardExpiryYear' => 2025,
            'cardExpiryMonth' => 12,
            'cardCvv' => '999',
        ]
    ]);

    $response = $client->getResponse();

    expect($response->getStatusCode())->toBe(200);
});
