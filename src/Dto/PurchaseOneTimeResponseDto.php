<?php

namespace App\Dto;

use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

final readonly class PurchaseOneTimeResponseDto
{
    public function __construct(
        public string $transactionId,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s'])]
        public \DateTimeImmutable $createdAt,
        public int $amount,
        public string $currency,
        public string $cardBin,
    ) {
    }
}
