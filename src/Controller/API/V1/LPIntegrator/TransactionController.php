<?php

declare(strict_types=1);

namespace App\Controller\API\V1\LPIntegrator;

use App\DTO\API\V1\LPIntegrator\Request\Transaction\Begin;
use App\DTO\API\V1\LPIntegrator\Request\Transaction\Rollback;
use App\DTO\API\V1\LPIntegrator\Response\Transaction\BeginTransactionResponseDto;
use App\DTO\API\V1\LPIntegrator\Response\Transaction\RollbackTransactionResponseDto;
use App\Exceptions\ApiResponseException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Route("/api/v1/transaction", name="transaction")
 */
class TransactionController extends LPIntegratorAbstractController
{
    /**
     * @Route("/begin", name="begin", methods={"POST"})
     * @ParamConverter("begin", converter="fos_rest.request_body")
     *
     * @param Begin $begin
     * @param ConstraintViolationListInterface $validationErrors
     * @return JsonResponse
     */
    public function begin(Begin $begin, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        try {
            $this->validationBodyParameters($validationErrors);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new BeginTransactionResponseDto())
            ->setBeginTransactionStatus(true);

        return $this->apiResponse($response);
    }

    /**
     * @Route("/rollback", name="rollback", methods={"POST"})
     * @ParamConverter("rollback", converter="fos_rest.request_body")
     *
     * @param Rollback $rollback
     * @param ConstraintViolationListInterface $validationErrors
     * @return JsonResponse
     */
    public function rollback(Rollback $rollback, ConstraintViolationListInterface $validationErrors): JsonResponse
    {
        try {
            $this->validationBodyParameters($validationErrors);
        } catch (ApiResponseException $e) {
            return $e->getJsonResponse();
        }

        $response = (new RollbackTransactionResponseDto())
            ->setRollbackTransactionStatus(true);

        return $this->apiResponse($response);
    }
}
