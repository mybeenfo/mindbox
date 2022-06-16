<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\Transaction;

use Symfony\Component\Validator\Constraints as Assert;

class Rollback
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $orderNumber;

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

}