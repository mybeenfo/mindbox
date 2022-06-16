<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\AuthCode;

use Symfony\Component\Validator\Constraints as Assert;

class Verify
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $orderNumber;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $code;

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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
