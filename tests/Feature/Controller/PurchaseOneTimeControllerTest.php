<?php

it('purchases one time using aci successfully', function () {
    $this->client->jsonRequest('POST', '/api/purchase-one-time/aci', [
        'amount' => 1,
        'currency' => 'USD',
        'cardNumber' => '4200000000000000',
        'cardExpiryYear' => 2025,
        'cardExpiryMonth' => 12,
        'cardCvv' => '999',
    ]);

    $response = $this->client->getResponse();

    expect($response->getStatusCode())->toBe(200);
});

it('purchases one time using shift4 successfully', function () {
    $this->client->jsonRequest('POST', '/api/purchase-one-time/shift4', [
        'amount' => 1,
        'currency' => 'USD',
        'cardNumber' => '4242424242424242',
        'cardExpiryYear' => 2025,
        'cardExpiryMonth' => 12,
        'cardCvv' => '999',
    ]);

    $response = $this->client->getResponse();

    expect($response->getStatusCode())->toBe(200);
});

it('throws an error when request is bad', function ($externalSystem) {
    $this->client->jsonRequest('POST', "/api/purchase-one-time/$externalSystem", [
        'amount' => 1,
        'currency' => 'USD',
        'cardNumber' => '9999999999999999', // invalid
        'cardExpiryYear' => 2025,
        'cardExpiryMonth' => 12,
        'cardCvv' => '999',
    ]);

    $response = $this->client->getResponse();

    expect($response->getStatusCode())->toBe(400);
})->with(['aci', 'shift4']);