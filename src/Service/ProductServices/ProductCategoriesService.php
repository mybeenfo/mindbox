<?php

declare(strict_types=1);

namespace App\Service\ProductServices;

use App\Entity\Monolith\ProductCategory;
use App\Entity\Monolith\ProductCategoryDescription;
use Doctrine\Persistence\ManagerRegistry;

class ProductCategoriesService
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getProductCategoriesByProductIds(array $productIds): array
    {
        $productCategoriesResult = [];

        $productCategories = $this->doctrine
            ->getRepository(ProductCategory::class, ProductsService::MONOLITH_ENTITY_MANAGER)
            ->getCategoriesByIds($productIds);

        $categoriesIds = [];
        foreach ($productCategories as $productCategory) {
            /** @var ProductCategory $productCategory */
            $categoriesIds[$productCategory->getCategoryId()] = $productCategory->getCategoryId();
        }

        if (empty($categoriesIds)) {
            return $productCategoriesResult;
        }

        $categoryDescriptions = $this->doctrine
            ->getRepository(ProductCategoryDescription::class, ProductsService::MONOLITH_ENTITY_MANAGER)
            ->getCategoryDescriptionsByCategoryIds($categoriesIds);

        foreach ($productCategories as $productCategory) {
            /** @var ProductCategory $productCategory */
            $categoryId = $productCategory->getCategoryId();
            if (isset($categoryDescriptions[$categoryId])) {
                $productCategoriesResult[$productCategory->getProductId()] = $productCategory->setCategoryName($categoryDescriptions[$categoryId]->getCategory());
            }
        }

        return $productCategoriesResult;
    }
}