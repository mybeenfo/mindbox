<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\Transaction;

use Symfony\Component\Validator\Constraints as Assert;

class Begin
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $orderNumber;

    /**
     * @Assert\Type("float")
     */
    private float $points;

    /**
     * @Assert\NotBlank
     * @Assert\Type("float")
     */
    private float $totalPrice;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $officeUuid;

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     * @return $this
     */
    public function setOrderNumber(string $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @return float
     */
    public function getPoints(): ?float
    {
        return $this->points;
    }

    /**
     * @param float|null $points
     * @return $this
     */
    public function setPoints(?float $points): self
    {
        $this->points = $points;

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

    /**
     * @return string
     */
    public function getOfficeUuid(): string
    {
        return $this->officeUuid;
    }

    /**
     * @param string $officeUuid
     * @return $this
     */
    public function setOfficeUuid(string $officeUuid): self
    {
        $this->officeUuid = $officeUuid;

        return $this;
    }
}
