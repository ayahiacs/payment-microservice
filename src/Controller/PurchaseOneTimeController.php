<?php

namespace App\Controller;

use App\Dto\PurchaseOneTimeRequestDto;
use App\Service\PurchaseOneTimeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use ApiPlatform\Metadata\Post;
use App\Dto\PurchaseOneTimeResponseDto;

#[Post(input: PurchaseOneTimeRequestDto::class, output: PurchaseOneTimeResponseDto::class)]
final class PurchaseOneTimeController extends AbstractController
{
    #[Route(
        '/purchase-one-time/{externalSystem}',
        name: 'purchase_one_time',
        methods: ['POST'],
        requirements: ['externalSystem' => 'aci|shift4']
    )]
    public function __invoke(
        $externalSystem,
        #[MapRequestPayload()] PurchaseOneTimeRequestDto $PurchaseOneTimeRequestDto,
        PurchaseOneTimeService $purchaseOneTimeService
    ): JsonResponse {
        $purchaseOneTimeResponseDto = $purchaseOneTimeService->purchaseOneTime($externalSystem, $PurchaseOneTimeRequestDto);

        return $this->json($purchaseOneTimeResponseDto);
    }
}
