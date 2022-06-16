<?php

declare(strict_types=1);

namespace App\Controller\API\V1\LPIntegrator;

use App\DTO\API\V1\LPIntegrator\Request\CustomerPoints\ForecastSearch;
use App\DTO\API\V1\LPIntegrator\Request\CustomerPoints\HistorySearch;
use App\DTO\API\V1\LPIntegrator\Response\CustomerPoints\BalanceResponseDto;
use App\DTO\API\V1\LPIntegrator\Response\CustomerPoints\ForecastSearchResponseDto;
use App\DTO\API\V1\LPIntegrator\Response\CustomerPoints\HistorySearchChangesResponseDto;
use App\DTO\API\V1\LPIntegrator\Response\CustomerPoints\HistorySearchResponseDto;
use App\Exceptions\ApiResponseException;
use App\Service\UserServices\UserService;
use Market\MicroserviceBundle\Context\RequestContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Route("/api/v1/customer/points", name="customer_points")
 */
class CustomerPointsController extends LPIntegratorAbstractController
{
    private UserService $userService;
    private RequestContext $requestContext;

    public function __construct(UserService $userService, RequestContext $requestContext)
    {
        $this->userService = $userService;
        $this->requestContext = $requestContext;
    }

    /**
     * @Route("/balance", name="balance", methods={"GET"})
     */
    public function balance(): JsonResponse
    {
        $userId = (int)$this->requestContext->getUserId();

        try {
            $userPhone = $this->userService->getPhoneByUserId($userId);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new BalanceResponseDto())
            ->setAvailablePoints(100.0)
            ->setBlockedPoints(1.0);

        return $this->apiResponse($response);
    }

    /**
     * @Route("/history/search", name="history_search", methods={"POST"})
     * @ParamConverter("historySearch", converter="fos_rest.request_body")
     */
    public function historySearch(HistorySearch $historySearch, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        $userId = (int)$this->requestContext->getUserId();

        try {
            $this->validationBodyParameters($validationErrors);

            $userPhone = $this->userService->getPhoneByUserId($userId);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new HistorySearchResponseDto())
            ->setChanges((new HistorySearchChangesResponseDto())
                ->setType('EXPIRED_POINTS')
                ->setAmount(-100.0)
                ->setOrderNumber(132456789)
                ->setTimestamp('2021-12-08T10:35:10.590Z')
                ->setExpirationTimestamp('2021-12-22T10:35:10.590Z')
            )
            ->setTotalCount(2);

        return $this->apiResponse($response);
    }

    /**
     * @Route("/forecast/search", name="forecast_search", methods={"POST"})
     * @ParamConverter("forecastSearch", converter="fos_rest.request_body")
     */
    public function forecastSearch(ForecastSearch $forecastSearch, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        $userId = (int)$this->requestContext->getUserId();

        try {
            $this->validationBodyParameters($validationErrors);

            $userPhone = $this->userService->getPhoneByUserId($userId);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new ForecastSearchResponseDto())
            ->setChanges([
                [
                    'type'      => 'EXPIRED_POINTS',
                    'amount'    => -20.0,
                    'timestamp' => '2021-12-24T06:19:06.373Z',
                ],
                [
                    'type'      => 'EXPIRED_POINTS',
                    'amount'    => -9.0,
                    'timestamp' => '2021-12-24T06:16:20.350Z',
                ],
                [
                    'type'      => 'EXPIRED_POINTS',
                    'amount'    => -0.0,
                    'timestamp' => '2021-12-24T06:15:11.367Z',
                ],
                [
                    'type'      => 'EXPIRED_POINTS',
                    'amount'    => -10.0,
                    'timestamp' => '2021-12-24T06:13:21.937Z',
                ],
                [
                    'type'      => 'EXPIRED_POINTS',
                    'amount'    => -100.0,
                    'timestamp' => '2021-12-22T10:35:10.590Z',
                ],
            ])
            ->setTotalAmount(-139.0)
            ->setTotalCount(5);

        return $this->apiResponse($response);
    }
}
