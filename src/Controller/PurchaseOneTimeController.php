<?php

namespace App\Controller;

use App\Dto\PurchaseOneTimeRequestDto;
use App\Dto\PurchaseOneTimeResponseDto;
use App\Service\PurchaseOneTimeService;
use Nelmio\ApiDocBundle\Attribute\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Annotations as OA;

final class PurchaseOneTimeController extends AbstractController
{
    #[OA\RequestBody(content: new Model(type: PurchaseOneTimeRequestDto::class, groups: ['full']))]
    #[OA\Response(response: 200, content: new Model(type: PurchaseOneTimeResponseDto::class, groups: ['full']))]
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
