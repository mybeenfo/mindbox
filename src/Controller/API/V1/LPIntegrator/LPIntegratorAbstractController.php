<?php

declare(strict_types=1);

namespace App\Controller\API\V1\LPIntegrator;

use App\Exceptions\ApiResponseException;
use Market\MicroserviceBundle\Controller\AbstractMicroserviceController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class LPIntegratorAbstractController extends AbstractMicroserviceController
{
    /**
     * @throws ApiResponseException
     */
    public function validationBodyParameters(ConstraintViolationListInterface $validationErrors): void
    {
        if (count($validationErrors) > 0) {
            $errors = [];
            foreach ($validationErrors as $error) {
                /** @var ConstraintViolation $error */
                $errors[$error->getPropertyPath()] = [
                    'property' => $error->getMessage(),
                    'value'    => $error->getParameters(),
                    'message'  => $error->getMessage(),
                ];
            }

            throw new ApiResponseException('PARAMETERS_IS_NOT_VALID', $errors);
        }
    }

    /**
     * @param Object $context
     * @return JsonResponse
     */
    public function apiResponse(Object $context): JsonResponse
    {
        return $this->json($context);
    }
}
