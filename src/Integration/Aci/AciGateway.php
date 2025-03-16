<?php

namespace App\Integration\Aci;

use App\Exception\PurchaseOneTimeException;
use App\Integration\Aci\Request\DebitPaymentRequest;
use App\Integration\Aci\Response\DebitPaymentResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class AciGateway
{
    public function __construct(
        private HttpClientInterface $client,
        private SerializerInterface $serializer,
        private string $apiKey,
        private string $baseUrl = 'https://eu-test.oppwa.com/v1',
    ) {}

    public function performDebitPayment(DebitPaymentRequest $request): DebitPaymentResponse
    {

        try {
            $response = $this->client->request('POST', $this->baseUrl . '/payments', [
                'headers' => [
                    'Authorization' => "Bearer {$this->apiKey}",
                    'Content-Type' => 'application/json',
                ],
                'body' => [
                    'entityId' => $request->entityId,
                    'amount' => $request->amount,
                    'currency' => $request->currency,
                    'paymentType' => $request->paymentType,
                    'card.number' => $request->card->number,
                    'card.holder' => $request->card->holder,
                    'card.expiryMonth' => $request->card->expiryMonth,
                    'card.expiryYear' => $request->card->expiryYear,
                    'card.cvv' => $request->card->cardCvv
                ],
            ]);
            $debitPaymentResponse = $this->serializer->deserialize(
                $response->getContent(), DebitPaymentResponse::class, 'json'
            );
        } catch (ClientExceptionInterface $e) {
            throw new PurchaseOneTimeException($response->getContent(false));
        } catch (ServerExceptionInterface $e) {
            throw new PurchaseOneTimeException($e->getMessage());
        }

        return $debitPaymentResponse;
    }
}
