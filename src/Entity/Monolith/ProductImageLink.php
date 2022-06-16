<?php

declare(strict_types=1);

namespace App\Entity\Monolith;

use App\Repository\Monolith\ProductImageLinkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductImageLinkRepository::class)
 * @ORM\Table(name="cscart_images_links")
 */
class ProductImageLink
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $pairId;

    /**
     * @ORM\Column(type="integer")
     */
    private int $objectId;

    /**
     * @ORM\Column(type="string")
     */
    private string $objectType;

    /**
     * @ORM\Column(type="integer")
     */
    private int $imageId;

    /**
     * @return int
     */
    public function getPairId(): int
    {
        return $this->pairId;
    }

    /**
     * @ORM\Column(type="string")
     */
    private string $type;

    /**
     * @param int $pairId
     * @return ProductImageLink
     */
    public function setPairId(int $pairId): self
    {
        $this->pairId = $pairId;

        return $this;
    }

    /**
     * @return int
     */
    public function getObjectId(): int
    {
        return $this->objectId;
    }

    /**
     * @param int $objectId
     * @return ProductImageLink
     */
    public function setObjectId(int $objectId): self
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * @return string
     */
    public function getObjectType(): string
    {
        return $this->objectType;
    }

    /**
     * @param string $objectType
     * @return ProductImageLink
     */
    public function setObjectType(string $objectType): self
    {
        $this->objectType = $objectType;

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
     * @param int $imageId
     * @return ProductImageLink
     */
    public function setImageId(int $imageId): self
    {
        $this->imageId = $imageId;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ProductImageLink
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
