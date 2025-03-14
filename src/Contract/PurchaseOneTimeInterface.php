<?php

namespace App\Contract;

use App\Dto\PurchaseOneTimeRequestDto;
use App\Dto\PurchaseOneTimeResponseDto;

interface PurchaseOneTimeInterface
{
    public function purchaseOneTime(PurchaseOneTimeRequestDto $PurchaseOneTimeRequestDto): PurchaseOneTimeResponseDto;
}