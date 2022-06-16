<?php

declare(strict_types=1);

namespace App\Entity\Monolith;

use App\Repository\Monolith\ProductDescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductDescriptionRepository::class)
 * @ORM\Table(name="cscart_product_descriptions")
 */
class ProductDescription
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $productId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $product;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $fullDescription;

    /**
     * @ORM\Column(type="string")
     */
    private string $langCode;

    /**
     * @ORM\Column(type="json")
     */
    private ?array $cdekFeaturesJson = [];

    /**
     * @param int $productId
     * @return ProductDescription
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getProduct(): string
    {
        return $this->product;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getCdekFeaturesJson(): ?array
    {
        return $this->cdekFeaturesJson;
    }

    /**
     * @param array|null $cdekFeaturesJson
     * @return ProductDescription
     */
    public function setCdekFeaturesJson(?array $cdekFeaturesJson): self
    {
        $this->cdekFeaturesJson = $cdekFeaturesJson;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    /**
     * @param string|null $fullDescription
     * @return ProductDescription
     */
    public function setFullDescription(?string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getLangCode(): string
    {
        return $this->langCode;
    }

    /**
     * @param string $langCode
     * @return ProductDescription
     */
    public function setLangCode(string $langCode): self
    {
        $this->langCode = $langCode;

        return $this;
    }
}
