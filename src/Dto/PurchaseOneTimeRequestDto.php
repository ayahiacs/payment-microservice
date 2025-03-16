<?php

namespace App\Dto;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseOneTimeRequestDto
{
    public function __construct(
        #[Assert\NotBlank()]
        #[Assert\Positive()]
        public int $amount,
        #[Assert\NotBlank()]
        #[Assert\Length(max: 3)]
        #[Assert\Regex(pattern: '/^AED|AFN|ALL|AMD|ANG|AOA|ARS|AUD|AWG|AZN|BAM|BBD|BDT|BGN|BHD|BIF|BMD|BND|BOB|BRL|BSD|BTN|BWP|BYR|BZD|CAD|CDF|CHF|CLP|CNY|COP|CRC|CUC|CUP|CVE|CZK|DJF|DKK|DOP|DZD|EGP|ERN|ETB|EUR|FJD|FKP|GBP|GEL|GGP|GHS|GIP|GMD|GNF|GTQ|GYD|HKD|HNL|HRK|HTG|HUF|IDR|ILS|IMP|INR|IQD|IRR|ISK|JEP|JMD|JOD|JPY|KES|KGS|KHR|KMF|KPW|KRW|KWD|KYD|KZT|LAK|LBP|LKR|LRD|LSL|LYD|MAD|MDL|MGA|MKD|MMK|MNT|MOP|MRO|MUR|MVR|MWK|MXN|MYR|MZN|NAD|NGN|NIO|NOK|NPR|NZD|OMR|PAB|PEN|PGK|PHP|PKR|PLN|PYG|QAR|RON|RSD|RUB|RWF|SAR|SBD|SCR|SDG|SEK|SGD|SHP|SLL|SOS|SPL|SRD|STD|SVC|SYP|SZL|THB|TJS|TMT|TND|TOP|TRY|TTD|TVD|TWD|TZS|UAH|UGX|USD|UYU|UZS|VEF|VND|VUV|WST|XAF|XCD|XDR|XOF|XPF|YER|ZAR|ZMW|ZWD$/')]
        #[OA\Property(example: 'USD')]
        public string $currency,
        #[Assert\NotBlank()]
        #[Assert\Length(exactly: 16)]
        #[Assert\Regex(pattern: '/^[0-9]{16}$/')]
        #[OA\Property(example: '4200000000000000')]
        public string $cardNumber,
        #[Assert\NotBlank()]
        #[Assert\GreaterThanOrEqual(2025)]
        public int $cardExpiryYear,
        #[Assert\NotBlank()]
        #[Assert\GreaterThanOrEqual(1)]
        #[Assert\LessThanOrEqual(12)]
        public int $cardExpiryMonth,
        #[Assert\NotBlank()]
        #[Assert\Length(exactly: 3)]
        #[Assert\Regex(pattern: '/^[0-9]{3}$/')]
        public string $cardCvv,
    ) {
    }
}
