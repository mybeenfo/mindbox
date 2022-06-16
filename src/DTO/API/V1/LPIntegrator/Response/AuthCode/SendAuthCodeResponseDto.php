<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\AuthCode;

class SendAuthCodeResponseDto
{
    /**
     * Статус запроса на генерацию кода SMS
     */
    private bool $sendAuthCode;

    /**
     * @return bool
     */
    public function isSendAuthCode(): bool
    {
        return $this->sendAuthCode;
    }

    /**
     * @param bool $sendAuthCode
     * @return $this
     */
    public function setSendAuthCode(bool $sendAuthCode): self
    {
        $this->sendAuthCode = $sendAuthCode;

        return $this;
    }
}
