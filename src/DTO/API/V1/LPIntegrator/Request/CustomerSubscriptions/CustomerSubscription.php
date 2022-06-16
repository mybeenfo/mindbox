<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\CustomerSubscriptions;

class CustomerSubscription
{
    private string $channel;
    private bool $subscribed;

    /**
     * @return string
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
    public function isSubscribed(): ?bool
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