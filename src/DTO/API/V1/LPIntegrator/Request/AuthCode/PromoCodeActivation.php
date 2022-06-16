<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\AuthCode;

use Symfony\Component\Validator\Constraints as Assert;

class PromoCodeActivation
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $promoCode;

    /**
     * @return string
     */
    public function getPromoCode(): string
    {
        return $this->promoCode;
    }

    /**
     * @param string $promoCode
     * @return $this
     */
    public function setPromoCode(string $promoCode): self
    {
        $this->promoCode = $promoCode;

        return $this;
    }
}
