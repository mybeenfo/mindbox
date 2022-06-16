<?php

declare(strict_types=1);

namespace App\Service\ProductServices;

use App\Entity\Monolith\Product;
use App\Entity\Monolith\ProductDescription;
use App\Entity\Monolith\ProductPrice;
use App\Mapper\ProductEntityMapper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

class ProductsService
{
    const MONOLITH_ENTITY_MANAGER = 'monolith';

    private ManagerRegistry $doctrine;
    private ProductEntityMapper $productEntityMapper;
    private ProductImagesService $productImagesService;
    private ProductCategoriesService $productCategoriesService;

    public function __construct(
        ManagerRegistry          $doctrine,
        ProductEntityMapper      $productEntityMapper,
        ProductImagesService     $productImagesService,
        ProductCategoriesService $productCategoriesService
    ) {
        $this->doctrine = $doctrine;
        $this->productEntityMapper = $productEntityMapper;
        $this->productImagesService = $productImagesService;
        $this->productCategoriesService = $productCategoriesService;
    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    public function getProductsByIds(array $productIds): ArrayCollection
    {
        $products = $this->doctrine
            ->getRepository(Product::class, ProductsService::MONOLITH_ENTITY_MANAGER)
            ->getProductsByIds($productIds);

        if (empty($products)) {
            throw new Exception('Products not found');
        }

        $productIds = $this->getProductIdsFromProductsCollection($products);

        $productCategories = $this->productCategoriesService->getProductCategoriesByProductIds($productIds);

        $descriptions = $this->doctrine
            ->getRepository(ProductDescription::class, ProductsService::MONOLITH_ENTITY_MANAGER)
            ->getDescriptionByIds($productIds);

        $prices = $this->doctrine
            ->getRepository(ProductPrice::class, ProductsService::MONOLITH_ENTITY_MANAGER)
            ->getPricesByIds($productIds);

        $images = $this->productImagesService->getProductsImagesByProductIds($productIds);

        return $this->productEntityMapper->entityCollectionFromService($products, $productCategories, $descriptions, $prices, $images);
    }

    private function getProductIdsFromProductsCollection(array $productCollection): array
    {
        $productIds = [];
        foreach ($productCollection as $product) {
            /** @var  Product $product */
            $productIds[] = $product->getProductId();
        }

        return $productIds;
    }
}