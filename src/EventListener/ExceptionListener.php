<?php

namespace App\EventListener;

use App\Exception\PurchaseOneTimeException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    function __construct(
        private ?LoggerInterface $logger
    ) {}

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        do {
            if ($exception instanceof PurchaseOneTimeException) {
                $this->handlePurchaseOneTimeException($event, $exception);

                return;
            }
        } while (null !== $exception = $exception->getPrevious());
    }

    private function handlePurchaseOneTimeException(ExceptionEvent $event, PurchaseOneTimeException $exception): void
    {
        $event->setResponse(new JsonResponse(
            ['error' => $exception->getMessage()],
            Response::HTTP_BAD_REQUEST
        ));
    }
}
