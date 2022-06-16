<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\CustomerSubscriptions;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateCustomerSubscriptions
{
    /**
     * @Assert\NotBlank
     */
    private ArrayCollection $subscriptions;

    /**
     * @return ArrayCollection
     */
    public function getSubscriptions(): ArrayCollection
    {
        return $this->subscriptions;
    }

    /**
     * @param array $subscriptions
     * @return $this
     */
    public function setSubscriptions(array $subscriptions): self
    {
        $result = new ArrayCollection();

        array_walk($subscriptions, function ($subscription) use (&$result) {
            /** @var CustomerSubscription $customerSubscription */
            $result->add((new CustomerSubscription())
                ->setChannel($subscription['channel'])
                ->setSubscribed($subscription['subscribed']));
        });

        $this->subscriptions = $result;

        return $this;
    }
}