<?php

namespace App\Service;

use App\Dto\PurchaseOneTimeRequestDto;
use App\Dto\PurchaseOneTimeResponseDto;
use App\Factory\PurchaseServiceFactory;

class PurchaseOneTimeService
{
    function __construct(
        private PurchaseServiceFactory $purchaseServiceFactory
    ) {}

    public function purchaseOneTime(string $externalSystem, PurchaseOneTimeRequestDto $PurchaseOneTimeRequestDto): PurchaseOneTimeResponseDto
    {
        $purchaseService = $this->purchaseServiceFactory->createPurshaseOneTimeService($externalSystem);

        $purchaseOnetimeResponseDto = $purchaseService->purchaseOneTime($PurchaseOneTimeRequestDto);

        return $purchaseOnetimeResponseDto;
    }
}
