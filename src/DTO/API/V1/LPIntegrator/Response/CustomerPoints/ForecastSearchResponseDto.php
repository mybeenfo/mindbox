<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\CustomerPoints;

class ForecastSearchResponseDto
{
    /**
     * Массив изменений баланса
     */
    private array $changes;

    /**
     * Сумма запланированного сгорания
     */
    private float $totalAmount;

    /**
     * Общее количество записей об изменении баланса
     */
    private int $totalCount;

    /**
     * @return array
     */
    public function getChanges(): array
    {
        return $this->changes;
    }

    /**
     * @param array $changes
     * @return $this
     */
    public function setChanges(array $changes): self
    {
        $result = [];

        array_walk($changes, function ($change) use (&$result) {
            $result[] = (new ForecastSearchChangeResponseDto())
                ->setType($change['type'])
                ->setAmount($change['amount'])
                ->setTimestamp($change['timestamp']);

        });

        $this->changes = $result;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     * @return $this
     */
    public function setTotalAmount(float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     * @return $this
     */
    public function setTotalCount(int $totalCount): self
    {
        $this->totalCount = $totalCount;

        return $this;
    }
}
