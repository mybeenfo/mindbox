<?php

declare(strict_types=1);

namespace App\Controller\API\V1\LPIntegrator;

use App\DTO\API\V1\LPIntegrator\Request\CustomerSubscriptions\UpdateCustomerSubscriptions;
use App\DTO\API\V1\LPIntegrator\Response\CustomerSubscriptions\CustomerSubscriptionResponseDto;
use App\DTO\API\V1\LPIntegrator\Response\CustomerSubscriptions\CustomerSubscriptionsResponseDto;
use App\DTO\API\V1\LPIntegrator\Response\CustomerSubscriptions\UpdateCustomerSubscriptionsResponseDto;
use App\Exceptions\ApiResponseException;
use App\Service\UserServices\UserService;
use Market\MicroserviceBundle\Context\RequestContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Route("/api/v1/customer/subscriptions", name="customer_subscriptions")
 */
class CustomerSubscriptionsController extends LPIntegratorAbstractController
{
    private UserService $userService;
    private RequestContext $requestContext;

    public function __construct(UserService $userService, RequestContext $requestContext)
    {
        $this->userService = $userService;
        $this->requestContext = $requestContext;
    }

    /**
     * @Route("/get", name="get_subscriptions", methods={"GET"})
     */
    public function getSubscriptions(): JsonResponse
    {
        $userId = (int)$this->requestContext->getUserId();

        try {
            $userPhone = $this->userService->getPhoneByUserId($userId);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new CustomerSubscriptionsResponseDto())
            ->setSubscriptions([
                [
                    'channel'    => CustomerSubscriptionResponseDto::SMS_CHANNEL,
                    'subscribed' => true,
                ],
                [
                    'channel'    => CustomerSubscriptionResponseDto::EMAIL_CHANNEL,
                    'subscribed' => false,
                ],
                [
                    'channel'    => CustomerSubscriptionResponseDto::VIBER_CHANNEL,
                    'subscribed' => true,
                ],
                [
                    'channel'    => CustomerSubscriptionResponseDto::PUSH_CHANNEL,
                    'subscribed' => false,
                ],
            ]);

        return $this->apiResponse($response);
    }

    /**
     * @Route("/update", name="subscriptions_update", methods={"PUT"})
     * @ParamConverter("customerSubscriptions", converter="fos_rest.request_body")
     */
    public function updateSubscriptions(UpdateCustomerSubscriptions $customerSubscriptions, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        $userId = (int)$this->requestContext->getUserId();

        try {
            $this->validationBodyParameters($validationErrors);

            $userPhone = $this->userService->getPhoneByUserId($userId);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new UpdateCustomerSubscriptionsResponseDto())
            ->setUpdateStatus(true);

        return $this->apiResponse($response);
    }
}