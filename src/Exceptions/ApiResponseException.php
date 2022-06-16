<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiResponseException extends Exception
{
    const CUSTOMER_NOT_FOUND = 'Customer not found';
    const PARAMETERS_IS_NOT_VALID = 'Parameters is not valid';

    private array $details;
    private int $responseCode;

    public function __construct(
        string    $message,
        array     $details = [],
        int       $responseCode = Response::HTTP_BAD_REQUEST,
        int       $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($this->getMessageCode($message), $code, $previous);
        $this->details = $details;
        $this->responseCode = $responseCode;
    }

    /**
     * @return JsonResponse
     */
    public function getJsonResponse(): JsonResponse
    {
        return new JsonResponse([
            'message' => $this->getMessage(),
            'code'    => $this->getCode(),
            'details' => $this->getDetails(),
        ], $this->responseCode);
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * Return message.
     */
    private function getMessageCode(string $message): string
    {
        $const = sprintf('%s::%s', static::class, $message);

        return constant($const);
    }
}
