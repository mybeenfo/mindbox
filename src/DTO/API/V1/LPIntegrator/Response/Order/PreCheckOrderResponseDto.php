<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\Order;

class PreCheckOrderResponseDto
{
    /**
     * Общее количество баллов, доступное в программе лояльности
     */
    private float $availableTotalBalancePoints;

    /**
     * Сумма баллов, доступная для оплаты данного заказа
     */
    private float $availableForCurrentOrderPoints;

    /**
     * Количество баллов, которое может быть накоплено за заказ
     */
    private float $willBeEarnedPoints;

    /**
     * Итоговая цена
     */
    private float $totalPrice;

    /**
     * @return float
     */
    public function getAvailableTotalBalancePoints(): float
    {
        return $this->availableTotalBalancePoints;
    }

    /**
     * @param float $availableTotalBalancePoints
     * @return $this
     */
    public function setAvailableTotalBalancePoints(float $availableTotalBalancePoints): self
    {
        $this->availableTotalBalancePoints = $availableTotalBalancePoints;

        return $this;
    }

    /**
     * @return float
     */
    public function getAvailableForCurrentOrderPoints(): float
    {
        return $this->availableForCurrentOrderPoints;
    }

    /**
     * @param float $availableForCurrentOrderPoints
     * @return $this
     */
    public function setAvailableForCurrentOrderPoints(float $availableForCurrentOrderPoints): self
    {
        $this->availableForCurrentOrderPoints = $availableForCurrentOrderPoints;

        return $this;
    }

    /**
     * @return float
     */
    public function getWillBeEarnedPoints(): float
    {
        return $this->willBeEarnedPoints;
    }

    /**
     * @param float $willBeEarnedPoints
     * @return $this
     */
    public function setWillBeEarnedPoints(float $willBeEarnedPoints): self
    {
        $this->willBeEarnedPoints = $willBeEarnedPoints;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     * @return $this
     */
    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }
}
