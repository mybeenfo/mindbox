<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Response\CustomerSubscriptions;

class CustomerSubscriptionsResponseDto
{
    /**
     * Список подписок на рассылки
     *
     * @var array
     */
    private array $subscriptions;

    /**
     * @return array
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }

    /**
     * @param array $subscriptions
     * @return $this
     */
    public function setSubscriptions(array $subscriptions): self
    {
        $result = [];

        array_walk($subscriptions, function ($subscription) use (&$result) {
            $result[] = (new CustomerSubscriptionResponseDto())
            ->setSubscribed($subscription['subscribed'])
            ->setChannel($subscription['channel']);
        });

        $this->subscriptions = $result;

        return $this;
    }
}