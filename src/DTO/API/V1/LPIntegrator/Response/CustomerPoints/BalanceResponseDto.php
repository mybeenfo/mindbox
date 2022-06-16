<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\CustomerPoints;

/**
 * Баланс бонусного счёта
 */
class BalanceResponseDto
{
    /**
     * Сумма баллов, доступная к трате
     */
    private float $availablePoints;

    /**
     * @var float
     */
    private float $blockedPoints;

    /**
     * Сумма баллов, недоступная к трате.
     * Баллы блокируются на время процесса оплаты с частичным покрытием баллами.
     */
    public function getAvailablePoints(): float
    {
        return $this->availablePoints;
    }

    /**
     * @param float $availablePoints
     * @return $this
     */
    public function setAvailablePoints(float $availablePoints): self
    {
        $this->availablePoints = $availablePoints;

        return $this;
    }

    /**
     * @return float
     */
    public function getBlockedPoints(): float
    {
        return $this->blockedPoints;
    }

    /**
     * @param float $blockedPoints
     * @return $this
     */
    public function setBlockedPoints(float $blockedPoints): self
    {
        $this->blockedPoints = $blockedPoints;

        return $this;
    }
}
