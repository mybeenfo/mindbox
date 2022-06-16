<?php

declare(strict_types=1);

namespace App\Entity\Monolith;

use App\Repository\Monolith\ProductCategoryDescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductCategoryDescriptionRepository::class)
 * @ORM\Table(name="cscart_category_descriptions")
 */
class ProductCategoryDescription
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $categoryId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $category;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private string $langCode;

    /**
     * @param int $categoryId
     * @return ProductCategoryDescription
     */
    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getLangCode(): string
    {
        return $this->langCode;
    }

    public function setLangCode(string $langCode): self
    {
        $this->langCode = $langCode;

        return $this;
    }
}
