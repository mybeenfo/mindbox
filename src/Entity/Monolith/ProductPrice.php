<?php

declare(strict_types=1);

namespace App\Entity\Monolith;

use App\Repository\Monolith\ProductPriceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductPriceRepository::class)
 * @ORM\Table(name="cscart_product_prices")
 */
class ProductPrice
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected int $productId;

    /**
     * @ORM\Column(type="float")
     */
    protected float $price;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $lowerLimit;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $usergroupId;

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductPrice
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return ProductPrice
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int
     */
    public function getLowerLimit(): int
    {
        return $this->lowerLimit;
    }

    /**
     * @param int $lowerLimit
     * @return ProductPrice
     */
    public function setLowerLimit(int $lowerLimit): self
    {
        $this->lowerLimit = $lowerLimit;

        return $this;
    }

    /**
     * @return int
     */
    public function getUsergroupId(): int
    {
        return $this->usergroupId;
    }

    /**
     * @param int $usergroupId
     * @return ProductPrice
     */
    public function setUsergroupId(int $usergroupId): self
    {
        $this->usergroupId = $usergroupId;

        return $this;
    }
}
