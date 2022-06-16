<?php

declare(strict_types=1);

namespace App\Controller\API\V1\LPIntegrator;

use App\DTO\API\V1\LPIntegrator\Request\AuthCode\PromoCodeActivation;
use App\DTO\API\V1\LPIntegrator\Request\AuthCode\Send;
use App\DTO\API\V1\LPIntegrator\Request\AuthCode\Verify;
use App\DTO\API\V1\LPIntegrator\Response\AuthCode\PromoCodeActivationResponseDto;
use App\DTO\API\V1\LPIntegrator\Response\AuthCode\SendAuthCodeResponseDto;
use App\DTO\API\V1\LPIntegrator\Response\AuthCode\VerifyAuthCodeResponseDto;
use App\Exceptions\ApiResponseException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Route("/api/v1/auth-code", name="auth_code")
 */
class AuthCodeController extends LPIntegratorAbstractController
{
    /**
     * @Route("/send", name="send", methods={"POST"})
     * @ParamConverter("send", converter="fos_rest.request_body")
     *
     * @param Send $send
     * @param ConstraintViolationListInterface $validationErrors
     * @return JsonResponse
     */
    public function send(Send $send, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        try {
            $this->validationBodyParameters($validationErrors);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new SendAuthCodeResponseDto())
            ->setSendAuthCode(true);

        return $this->apiResponse($response);
    }

    /**
     * @Route("/verify", name="verify_code", methods={"POST"})
     * @ParamConverter("verify", converter="fos_rest.request_body")
     *
     * @param Verify $verify
     * @param ConstraintViolationListInterface $validationErrors
     * @return JsonResponse
     */
    public function verify(Verify $verify, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        try {
            $this->validationBodyParameters($validationErrors);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new VerifyAuthCodeResponseDto())
            ->setVerifyAuthCode(true);

        return $this->apiResponse($response);
    }

    /**
     * @Route("/promo-code-activation", name="verify", methods={"POST"})
     * @ParamConverter("promoCodeActivation", converter="fos_rest.request_body")
     *
     * @param PromoCodeActivation $promoCodeActivation
     * @param ConstraintViolationListInterface $validationErrors
     * @return void
     */
    public function promoCodeActivation(PromoCodeActivation $promoCodeActivation, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        try {
            $this->validationBodyParameters($validationErrors);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new PromoCodeActivationResponseDto())
            ->setEarnedPoints(10.0);

        return $this->apiResponse($response);
    }
}
