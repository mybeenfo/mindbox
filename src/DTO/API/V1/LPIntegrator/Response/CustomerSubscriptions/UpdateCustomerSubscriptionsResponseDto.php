<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\CustomerSubscriptions;

class UpdateCustomerSubscriptionsResponseDto
{
    /**
     * Статус обновления подписки на рассылки
     */
    private bool $updateStatus;

    /**
     * @return bool
     */
    public function isUpdateStatus(): bool
    {
        return $this->updateStatus;
    }

    /**
     * @param bool $updateStatus
     * @return $this
     */
    public function setUpdateStatus(bool $updateStatus): self
    {
        $this->updateStatus = $updateStatus;

        return $this;
    }
}