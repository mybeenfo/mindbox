<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\CustomerSubscriptions;

class CustomerSubscriptionResponseDto
{
    const SMS_CHANNEL = 'SMS';
    const EMAIL_CHANNEL = 'EMAIL';
    const VIBER_CHANNEL = 'VIBER';
    const PUSH_CHANNEL = 'PUSH';

    /**
     * Канал коммуникации с клиентом
     * SMS
     * EMAIL
     * VIBER
     * PUSH
     */
    private ?string $channel;

    /**
     * Признак наличия подписки по каналу
     */
    private ?bool $subscribed;

    /**
     * @return string|null
     */
    public function getChannel(): ?string
    {
        return $this->channel;
    }

    /**
     * @param string|null $channel
     * @return $this
     */
    public function setChannel(?string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSubscribed(): ?bool
    {
        return $this->subscribed;
    }

    /**
     * @param bool|null $subscribed
     * @return $this
     */
    public function setSubscribed(?bool $subscribed): self
    {
        $this->subscribed = $subscribed;

        return $this;
    }
}