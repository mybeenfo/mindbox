<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\Transaction;

class RollbackTransactionResponseDto
{
    /**
     * Статус запроса на отмену запущенной распределенной транзакции
     */
    private bool $rollbackTransactionStatus;

    /**
     * @return bool
     */
    public function isRollbackTransactionStatus(): bool
    {
        return $this->rollbackTransactionStatus;
    }

    /**
     * @param bool $rollbackTransactionStatus
     * @return $this
     */
    public function setRollbackTransactionStatus(bool $rollbackTransactionStatus): self
    {
        $this->rollbackTransactionStatus = $rollbackTransactionStatus;

        return $this;
    }
}
