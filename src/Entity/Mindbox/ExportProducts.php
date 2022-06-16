<?php

declare(strict_types=1);

namespace App\Entity\Mindbox;

use App\Repository\Mindbox\ExportProductsRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExportProductsRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class ExportProducts
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidOrderedTimeGenerator")
     */
    private string $id;

    /**
     * @ORM\Column(type="json")
     */
    private array $productsIds = [];

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $dateInsert;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function getProductsIds(): ?array
    {
        return $this->productsIds;
    }

    public function setProductsIds(array $productsIds): self
    {
        $this->productsIds = $productsIds;

        return $this;
    }

    public function getDateInsert(): ?DateTimeInterface
    {
        return $this->dateInsert;
    }

    public function setDateInsert(?DateTimeInterface $dateInsert): self
    {
        $this->dateInsert = $dateInsert;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateInsertValue(): void
    {
        $this->dateInsert = new DateTime();
    }
}
