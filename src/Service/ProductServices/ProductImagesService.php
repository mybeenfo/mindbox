<?php

declare(strict_types=1);

namespace App\Service\ProductServices;

use App\Entity\Monolith\ProductImage;
use App\Entity\Monolith\ProductImageLink;
use Doctrine\Persistence\ManagerRegistry;

class ProductImagesService
{
    private const OBJECT_TYPE = 'product';

    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getProductsImagesByProductIds(array $productIds): array
    {
        $productImages = [];

        $imageLinks = $this->doctrine->getRepository(ProductImageLink::class, ProductsService::MONOLITH_ENTITY_MANAGER)
            ->findByType($productIds, self::OBJECT_TYPE);

        $imageIds = [];
        foreach ($imageLinks as $productImageLinks) {
            foreach ($productImageLinks as $productImageLink) {
                /* @var ProductImageLink $productImageLink */
                $imageIds[] = $productImageLink->getImageId();
            }
        }

        $images = $this->doctrine->getRepository(ProductImage::class, ProductsService::MONOLITH_ENTITY_MANAGER)
            ->findByIds($imageIds);

        foreach ($productIds as $productId) {
            if (isset($imageLinks[$productId])) {
                $image = $this->getImage($imageLinks[$productId], $images);
                if ($image) {
                    $productImages[$productId] = $this->getImage($imageLinks[$productId], $images);
                }
            }
        }

        return $productImages;
    }

    /**
     * Добавление картинок к товару
     *
     * @param array $imageLinks
     * @param array $images
     * @return array|null
     */
    protected function getImage(array $imageLinks, array $images): ?array
    {
        $imagesLinks = [];
        foreach ($imageLinks as $imageLink) {
            /** @var ProductImageLink $imageLink */
            $imageLinkId = $imageLink->getImageId();
            if (isset($images[$imageLinkId])) {
                $imagesLinks[] = $images[$imageLinkId];
            }
        }

        return $imagesLinks;
    }
}