<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\CustomerPoints;

class HistorySearchChangesResponseDto
{
    /**
     * Тип изменения баланса
     */
    private string $type;

    /**
     * Сумма, на которую изменился баланс
     */
    private float $amount;

    /**
     * Номер заказа, в соответствии с которым изменился баланс.
     *
     * @var int
     */
    private int $orderNumber;

    /**
     * Дата и время изменения баланса
     *
     * @var string
     */
    private string $timestamp;

    /**
     * Дата и время сгорания бонусов. Только для начислений на баланс
     *
     * @var string
     */
    private string $expirationTimestamp;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    /**
     * @param int $orderNumber
     * @return $this
     */
    public function setOrderNumber(int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     * @return $this
     */
    public function setTimestamp(string $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpirationTimestamp(): string
    {
        return $this->expirationTimestamp;
    }

    /**
     * @param string $expirationTimestamp
     * @return $this
     */
    public function setExpirationTimestamp(string $expirationTimestamp): self
    {
        $this->expirationTimestamp = $expirationTimestamp;

        return $this;
    }
}