<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\Order;

use Symfony\Component\Validator\Constraints as Assert;

class PreCheckNonSaved
{
    /**
     * Валюта взаиморасчетов
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $commonCurrencyCode;

    /**
     * Город отправителя
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $senderCityCode;

    /**
     * Город получателя
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $receiverCityCode;

    /**
     * Форма оплаты
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $paymentMethodCode;

    /**
     * Цена услуги доставки
     *
     * @Assert\NotBlank
     * @Assert\Type("float")
     */
    private float $deliveryPriceCost;

    /**
     * Сумма скидки
     *
     * @Assert\NotBlank
     * @Assert\Type("float")
     */
    private float $discountsCost;

    /**
     * Код интерфейса с которого создали заказ (web /mobile).
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private string $creatingInterfaceCode;

    /**
     * @return string
     */
    public function getCommonCurrencyCode(): string
    {
        return $this->commonCurrencyCode;
    }

    /**
     * @param string $commonCurrencyCode
     * @return $this
     */
    public function setCommonCurrencyCode(string $commonCurrencyCode): self
    {
        $this->commonCurrencyCode = $commonCurrencyCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getSenderCityCode(): string
    {
        return $this->senderCityCode;
    }

    /**
     * @param string $senderCityCode
     * @return $this
     */
    public function setSenderCityCode(string $senderCityCode): self
    {
        $this->senderCityCode = $senderCityCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getReceiverCityCode(): string
    {
        return $this->receiverCityCode;
    }

    /**
     * @param string $receiverCityCode
     * @return $this
     */
    public function setReceiverCityCode(string $receiverCityCode): self
    {
        $this->receiverCityCode = $receiverCityCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethodCode(): string
    {
        return $this->paymentMethodCode;
    }

    /**
     * @param string $paymentMethodCode
     * @return $this
     */
    public function setPaymentMethodCode(string $paymentMethodCode): self
    {
        $this->paymentMethodCode = $paymentMethodCode;

        return $this;
    }

    /**
     * @return float
     */
    public function getDeliveryPriceCost(): float
    {
        return $this->deliveryPriceCost;
    }

    /**
     * @param float $deliveryPriceCost
     * @return $this
     */
    public function setDeliveryPriceCost(float $deliveryPriceCost): self
    {
        $this->deliveryPriceCost = $deliveryPriceCost;

        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountsCost(): float
    {
        return $this->discountsCost;
    }

    /**
     * @param float $discountsCost
     * @return $this
     */
    public function setDiscountsCost(float $discountsCost): self
    {
        $this->discountsCost = $discountsCost;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatingInterfaceCode(): string
    {
        return $this->creatingInterfaceCode;
    }

    /**
     * @param string $creatingInterfaceCode
     * @return $this
     */
    public function setCreatingInterfaceCode(string $creatingInterfaceCode): self
    {
        $this->creatingInterfaceCode = $creatingInterfaceCode;

        return $this;
    }
}
