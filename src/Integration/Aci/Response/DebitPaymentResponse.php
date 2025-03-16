<?php

namespace App\Integration\Aci\Response;

class DebitPaymentResponse
{
    public function __construct(
        public string $id,
        public string $paymentType,
        public string $paymentBrand,
        public string $amount,
        public string $currency,
        public string $descriptor,
        public Result $result,
        public ResultDetails $resultDetails,
        public Card $card,
        public Risk $risk,
        public string $buildNumber,
        public string $timestamp,
        public string $ndc,
    ) {
    }
}
