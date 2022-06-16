<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\AuthCode;

class PromoCodeActivationResponseDto
{
    /**
     * Количество активированных баллов по промо коду
     */
    private float $earnedPoints;

    /**
     * @return float
     */
    public function getEarnedPoints(): float
    {
        return $this->earnedPoints;
    }

    /**
     * @param float $earnedPoints
     * @return $this
     */
    public function setEarnedPoints(float $earnedPoints): self
    {
        $this->earnedPoints = $earnedPoints;

        return $this;
    }
}
