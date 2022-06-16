<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\Order;

use Symfony\Component\Validator\Constraints as Assert;

class PreCheck
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
     * @return float|null
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