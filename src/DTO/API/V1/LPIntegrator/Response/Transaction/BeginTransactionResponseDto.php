<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\Transaction;

class BeginTransactionResponseDto
{
    /**
     * Статус запроса на запуск распределенной транзакции Begin
     */
    private bool $beginTransactionStatus;

    /**
     * @return bool
     */
    public function isBeginTransactionStatus(): bool
    {
        return $this->beginTransactionStatus;
    }

    /**
     * @param bool $beginTransactionStatus
     * @return $this
     */
    public function setBeginTransactionStatus(bool $beginTransactionStatus): self
    {
        $this->beginTransactionStatus = $beginTransactionStatus;

        return $this;
    }
}
