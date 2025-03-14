<?php

namespace App\Integration\Aci;

use App\Integration\Aci\Request\DebitPaymentRequest;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class AciGateway
{
    public function __construct(
        private HttpClientInterface $client,
        private string $apiKey = 'OGFjN2E0Yzc5Mzk0YmRjODAxOTM5NzM2ZjFhNzA2NDF8enlac1lYckc4QXk6bjYzI1NHNng=',
        private string $baseUrl = 'https://eu-test.oppwa.com/v1',
    ) {}

    public function performDebitPayment(DebitPaymentRequest $request)
    {
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

        dd($response->getContent(false));

        return json_decode($response->getContent(), true);
    }
}
