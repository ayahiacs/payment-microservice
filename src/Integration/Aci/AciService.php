<?php

namespace App\Integration\Aci;

use App\Contract\PurchaseOneTimeInterface;
use App\Dto\PurchaseOneTimeRequestDto;
use App\Dto\PurchaseOneTimeResponseDto;
use App\Integration\Aci\Request\DebitPaymentRequest;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class AciService implements PurchaseOneTimeInterface, ServiceSubscriberInterface
{

    public function __construct(
        private ContainerInterface $locator,
        private ?AciGateway $aciGateway = null
    ) {
        if (null === $this->aciGateway) {
            $this->aciGateway = $this->locator->get('aciGateway');
        }
    }

    public static function getSubscribedServices(): array
    {
        return [
            'aciGateway' => AciGateway::class,
        ];
    }
    /**
     * 
     * 
     */
    public function purchaseOneTime(PurchaseOneTimeRequestDto $purchaseOneTimeRequestDto): PurchaseOneTimeResponseDto
    {
        $charge = $this->aciGateway->performDebitPayment(DebitPaymentRequest::createFromPurchaseOneTimeRequestDto($purchaseOneTimeRequestDto));

        return new PurchaseOneTimeResponseDto(
            transactionId: $charge->getId(),
            createdAt: $charge->getCreated(),
            amount: $charge->getAmount(),
            currency: $charge->getCurrency(),
            cardBin: $charge->getCard()->getFirst6(),
        );
    }
}
