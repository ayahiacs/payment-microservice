<?php

namespace App\Factory;

use App\Contract\PurchaseOneTimeInterface;
use App\Integration\Aci\AciService;
use App\Integration\Shift4\Shift4Service;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class PurchaseServiceFactory implements ServiceSubscriberInterface
{
    public function __construct(
        private ContainerInterface $locator,
    ) {
    }

    /**
     * here we can register new external systems services.
     */
    public static function getSubscribedServices(): array
    {
        return [
            'aci' => AciService::class,
            'shift4' => Shift4Service::class,
        ];
    }

    /**
     * Create a purchase service object based on the given external system.
     *
     * @param string $externalSystem the external system for which to create the service
     *
     * @return PurchaseOneTimeInterface the service
     */
    public function createPurshaseOneTimeService(string $externalSystem): PurchaseOneTimeInterface
    {
        return $this->locator->get($externalSystem);
    }
}
