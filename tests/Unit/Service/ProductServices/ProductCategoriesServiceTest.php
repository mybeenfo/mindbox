<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\ProductServices;

use App\Entity\Monolith\ProductCategory;
use App\Repository\Monolith\ProductCategoryDescriptionRepository;
use App\Repository\Monolith\ProductCategoryRepository;
use App\Service\ProductServices\ProductCategoriesService;
use App\Tests\Fixtures\ProductCategoryDescriptionFixture;
use App\Tests\Fixtures\ProductCategoryFixture;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

class ProductCategoriesServiceTest extends TestCase
{
    public function testGetProductCategoriesByProductIds()
    {
        $productId = 8627474;
        $categoryId = 306;

        $productCategoryFixture = ProductCategoryFixture::category($productId);
        $productCategories[] = $productCategoryFixture;
        $productCategoryRepository = $this->createMock(ProductCategoryRepository::class);
        $productCategoryRepository->expects($this->any())
            ->method('getCategoriesByIds')
            ->willReturn($productCategories);

        $productCategoryDescriptionFixture = ProductCategoryDescriptionFixture::categoryDescription($categoryId);
        $productCategoryDescriptions[$categoryId] = $productCategoryDescriptionFixture;
        $productCategoryDescriptionRepository = $this->createMock(ProductCategoryDescriptionRepository::class);
        $productCategoryDescriptionRepository->expects($this->any())
            ->method('getCategoryDescriptionsByCategoryIds')
            ->willReturn($productCategoryDescriptions);

        $objectManager = $this->createMock(ManagerRegistry::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturnOnConsecutiveCalls($productCategoryRepository, $productCategoryDescriptionRepository);

        $productCategoriesService = new ProductCategoriesService($objectManager);
        $productCategoriesResult = $productCategoriesService->getProductCategoriesByProductIds([$productId]);
        $productCategoryResult = $productCategoriesResult[$productId];

        $this->assertIsArray($productCategories);
        $this->assertInstanceOf(ProductCategory::class, $productCategoryResult);
        $this->assertEquals($productCategoryFixture, $productCategoryResult);
    }
}
