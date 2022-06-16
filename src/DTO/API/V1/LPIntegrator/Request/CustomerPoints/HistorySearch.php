<?php

declare(strict_types=1);

namespace App\DTO\API\V1\LPIntegrator\Request\CustomerPoints;

use Symfony\Component\Validator\Constraints as Assert;

class HistorySearch
{
    /**
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 1,
     *      max = 21474831
     * )
     *
     * @var int
     */
    private int $pageNumber;

    /**
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 1,
     *      max = 1000
     * )
     * @var int
     */
    private int $itemsPerPage;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     *
     * @var string
     */
    private string $timestampFrom;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     *
     * @var string
     */
    private string $timestampTo;

    /**
     * @return int
     */
    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    /**
     * @param int $pageNumber
     * @return $this
     */
    public function setPageNumber(int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     * @return $this
     */
    public function setItemsPerPage(int $itemsPerPage): self
    {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimestampFrom(): string
    {
        return $this->timestampFrom;
    }

    /**
     * @param string $timestampFrom
     * @return $this
     */
    public function setTimestampFrom(string $timestampFrom): self
    {
        $this->timestampFrom = $timestampFrom;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimestampTo(): string
    {
        return $this->timestampTo;
    }

    /**
     * @param string $timestampTo
     * @return $this
     */
    public function setTimestampTo(string $timestampTo): self
    {
        $this->timestampTo = $timestampTo;

        return $this;
    }
}
