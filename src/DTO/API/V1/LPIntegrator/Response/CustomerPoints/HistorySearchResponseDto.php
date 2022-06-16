<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\CustomerPoints;

/**
 * История изменений баланса бонусного счета
 */
class HistorySearchResponseDto
{
    /**
     * Объект изменений баланса
     *
     * @var HistorySearchChangesResponseDto
     */
    private HistorySearchChangesResponseDto $changes;

    /**
     * Общее количество записей об изменении баланса
     *
     * @var int
     */
    private int $totalCount;

    /**
     *
     *
     * @return HistorySearchChangesResponseDto
     */
    public function getChanges(): HistorySearchChangesResponseDto
    {
        return $this->changes;
    }

    /**
     * @param HistorySearchChangesResponseDto $changes
     * @return $this
     */
    public function setChanges(HistorySearchChangesResponseDto $changes): self
    {
        $this->changes = $changes;

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
