<?php

use App\Dto\PurchaseOneTimeResponseDto;
use App\Exception\PurchaseOneTimeException;
use App\Service\PurchaseOneTimeService;
use App\Tests\WebTestCase;

it('purchases one time using aci and shift 4 successfully', function ($externalSystem) {
    /** @var WebTestCase $this */
    $purchaseOneTimeService = $this->createMock(PurchaseOneTimeService::class);
    $purchaseOneTimeService->expects(self::once())
        ->method('purchaseOneTime')
        ->willReturn(new PurchaseOneTimeResponseDto(
            transactionId: '123',
            createdAt: new DateTimeImmutable('now'),
            amount: 1,
            currency: 'USD',
            cardBin: '420000',
        ));
    $this->container->set(PurchaseOneTimeService::class, $purchaseOneTimeService);

    $this->client->jsonRequest('POST', "/api/purchase-one-time/$externalSystem", [
        'amount' => 1,
        'currency' => 'USD',
        'cardNumber' => '4200000000000000',
        'cardExpiryYear' => 2025,
        'cardExpiryMonth' => 12,
        'cardCvv' => '999',
    ]);

    $response = $this->client->getResponse();

    expect($response->getStatusCode())->toBe(200);
})->with(['aci', 'shift4']);

it('throws an error when request is bad', function ($externalSystem) {
    $this->client->jsonRequest('POST', "/api/purchase-one-time/$externalSystem", [
        'amount' => 1,
        'currency' => 'USD',
        'cardNumber' => '999999999999999999999999', // invalid
        'cardExpiryYear' => 2025,
        'cardExpiryMonth' => 12,
        'cardCvv' => '999',
    ]);

    $response = $this->client->getResponse();

    expect($response->getStatusCode())->toBe(422);
})->with(['aci', 'shift4']);

it('throws an error when external system return an error', function ($externalSystem) {
    /** @var WebTestCase $this */
    $purchaseOneTimeService = $this->createMock(PurchaseOneTimeService::class);
    $purchaseOneTimeService->expects(self::once())
        ->method('purchaseOneTime')
        ->willThrowException(new PurchaseOneTimeException('error'));
    $this->container->set(
        PurchaseOneTimeService::class,
        $purchaseOneTimeService
    );

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
