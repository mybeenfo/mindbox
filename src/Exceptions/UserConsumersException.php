<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class UserConsumersException extends Exception
{
    const PARAMETER_USER_ID_IS_EMPTY = 'Parameter userId from rabbitMQ is empty';

    /**
     * Параметры сообщения.
     */
    private array $messageParams = [];

    public function __construct(
        string    $message,
        array     $messageParams = [],
        Throwable $previous = null
    ) {
        parent::__construct($message, $previous, $this->getMessageCode($message));
        $this->messageParams = $messageParams;
    }

    public function getMessageParams(): array
    {
        return $this->messageParams;
    }

    /**
     * Return message code.
     */
    private function getMessageCode(string $message): string
    {
        $const = sprintf('%s::%s', static::class, $message);

        return constant($const);
    }
}
