<?php

declare(strict_types=1);

namespace App\Entity\Monolith;

use App\Repository\Monolith\ProductImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductImageRepository::class)
 * @ORM\Table(name="cscart_images")
 */
class ProductImage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $imageId;

    /**
     * @ORM\Column(type="string")
     */
    private string $imagePath;

    protected string $imageUrl;

    /**
     * @param int $imageId
     * @return ProductImage
     */
    public function setImageId(int $imageId): self
    {
        $this->imageId = $imageId;

        return $this;
    }

    /**
     * @return int
     */
    public function getImageId(): int
    {
        return $this->imageId;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     * @return ProductImage
     */
    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }
}
