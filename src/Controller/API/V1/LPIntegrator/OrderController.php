<?php

declare(strict_types=1);

namespace App\Controller\API\V1\LPIntegrator;

use App\DTO\API\V1\LPIntegrator\Request\Order\PreCheck;
use App\DTO\API\V1\LPIntegrator\Request\Order\PreCheckNonSaved;
use App\DTO\API\V1\LPIntegrator\Response\Order\PreCheckOrderNonSavedResponseDto;
use App\DTO\API\V1\LPIntegrator\Response\Order\PreCheckOrderResponseDto;
use App\Exceptions\ApiResponseException;
use App\Service\UserServices\UserService;
use Market\MicroserviceBundle\Context\RequestContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Route("/api/v1/order", name="auth_code")
 */
class OrderController extends LPIntegratorAbstractController
{
    private UserService $userService;
    private RequestContext $requestContext;

    public function __construct(UserService $userService, RequestContext $requestContext)
    {
        $this->userService = $userService;
        $this->requestContext = $requestContext;
    }

    /**
     * @Route("/precheck", name="precheck", methods={"POST"})
     * @ParamConverter("preCheck", converter="fos_rest.request_body")
     *
     * @param PreCheck $preCheck
     * @param ConstraintViolationListInterface $validationErrors
     * @return JsonResponse
     */
    public function preCheck(PreCheck $preCheck, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        try {
            $this->validationBodyParameters($validationErrors);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $result = (new PreCheckOrderResponseDto())
            ->setAvailableTotalBalancePoints(100.0)
            ->setAvailableForCurrentOrderPoints(100.0)
            ->setWillBeEarnedPoints(23.46)
            ->setTotalPrice(234.56);

        return $this->apiResponse($result);
    }

    /**
     * @Route("/precheck-non-saved", name="precheck_non_saved", methods={"POST"})
     * @ParamConverter("preCheckNonSaved", converter="fos_rest.request_body")
     *
     * @param PreCheckNonSaved $preCheckNonSaved
     * @param ConstraintViolationListInterface $validationErrors
     * @return JsonResponse
     */
    public function preCheckNonSaved(PreCheckNonSaved $preCheckNonSaved, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        $userId = (int)$this->requestContext->getUserId();

        try {
            $this->validationBodyParameters($validationErrors);

            $userPhone = $this->userService->getPhoneByUserId($userId);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $result = (new PreCheckOrderNonSavedResponseDto())
            ->setAvailableTotalBalancePoints(100.0)
            ->setAvailableForCurrentOrderPoints(100.0)
            ->setWillBeEarnedPoints(23.46)
            ->setTotalPrice(234.56);

        return $this->apiResponse($result);
    }
}
