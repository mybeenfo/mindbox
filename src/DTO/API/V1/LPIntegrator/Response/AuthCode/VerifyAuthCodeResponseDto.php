<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\AuthCode;

class VerifyAuthCodeResponseDto
{
    /**
     * Статус запроса на подтверждение кода SMS
     */
    private bool $verifyAuthCode;

    /**
     * @return bool
     */
    public function isVerifyAuthCode(): bool
    {
        return $this->verifyAuthCode;
    }

    /**
     * @param bool $verifyAuthCode
     * @return $this
     */
    public function setVerifyAuthCode(bool $verifyAuthCode): self
    {
        $this->verifyAuthCode = $verifyAuthCode;

        return $this;
    }
}
