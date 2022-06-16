<?php

declare(strict_types=1);

namespace App\Entity\Monolith;

use App\Repository\Monolith\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table(name="cscart_products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */

    private int $productId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $cdekSeoName;

    /**
     * @ORM\Column(type="integer")
     */
    private int $amount;

    /**
     * @param int $productId
     * @return Product
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getCdekSeoName(): string
    {
        return $this->cdekSeoName;
    }

    /**
     * @param string $cdekSeoName
     * @return Product
     */
    public function setCdekSeoName(string $cdekSeoName): self
    {
        $this->cdekSeoName = $cdekSeoName;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Product
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
