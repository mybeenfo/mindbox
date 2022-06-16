<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\AuthCode;

use Symfony\Component\Validator\Constraints as Assert;

class Send
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $orderNumber;

    /**
     * @Assert\NotBlank
     * @Assert\Type("float")
     */
    private float $points;

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
    public function getPoints(): float
    {
        return $this->points;
    }

    /**
     * @param float $points
     * @return $this
     */
    public function setPoints(float $points): self
    {
        $this->points = $points;

        return $this;
    }
}
