<?php

use App\Dto\PurchaseOneTimeResponseDto;
use App\Service\PurchaseOneTimeService;

it('uses the correct payment gateway in command', function ($externalSystem) {
    $purchaseOneTimeService = $this->createMock(PurchaseOneTimeService::class);
    $purchaseOneTimeService->expects(self::once())
        ->method('purchaseOneTime')
        ->willReturn(new PurchaseOneTimeResponseDto(
            transactionId: '123',
            createdAt: new DateTimeImmutable('now'),
            amount: 100,
            currency: 'EUR',
            cardBin: '123456',
        ));
    $this->container->set(PurchaseOneTimeService::class, $purchaseOneTimeService);

    $command = $this->executeCommand(
        'app:purchase-one-time',
        ['externalSystem' => $externalSystem],
    );

    $command->assertCommandIsSuccessful();

    $output = $command->getDisplay();

    $this->assertStringContainsString($externalSystem, $output);
    $this->assertStringContainsString('successfully', $output);
})->with([
    'shift4',
    'aci',
]);
