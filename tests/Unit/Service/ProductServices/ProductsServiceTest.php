<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\ProductServices;

use App\Mapper\ProductEntityMapper;
use App\Repository\Monolith\ProductDescriptionRepository;
use App\Repository\Monolith\ProductPriceRepository;
use App\Repository\Monolith\ProductRepository;
use App\Service\ProductServices\ProductCategoriesService;
use App\Service\ProductServices\ProductImagesService;
use App\Service\ProductServices\ProductsService;
use App\Tests\AssertsCheckers\ProductsAssertsChecker;
use App\Tests\Fixtures\ProductCategoryFixture;
use App\Tests\Fixtures\ProductDescriptionFixture;
use App\Tests\Fixtures\ProductFixture;
use App\Tests\Fixtures\ProductImageFixture;
use App\Tests\Fixtures\ProductPriceFixture;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductsServiceTest extends KernelTestCase
{
    public function testGetProductsByIds(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $productId = 694162;

        $productFixture = ProductFixture::product($productId);
        $products[$productId] = $productFixture;
        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository->expects($this->any())
            ->method('getProductsByIds')
            ->willReturn($products);

        $productDescriptionFixture = ProductDescriptionFixture::description($productId, 'Товар ' . $productId, 'Описание товара ' . $productId);
        $productDescriptions[$productId] = $productDescriptionFixture;
        $descriptionRepository = $this->createMock(ProductDescriptionRepository::class);
        $descriptionRepository->expects($this->any())
            ->method('getDescriptionByIds')
            ->willReturn($productDescriptions);

        $productPriceFixture = ProductPriceFixture::price($productId);
        $productPrices[$productId] = $productPriceFixture;
        $productPriceRepository = $this->createMock(ProductPriceRepository::class);
        $productPriceRepository->expects($this->any())
            ->method('getPricesByIds')
            ->willReturn($productPrices);

        $objectManagers = $this->createMock(ManagerRegistry::class);
        $objectManagers->expects($this->any())
            ->method('getRepository')
            ->willReturnOnConsecutiveCalls($productRepository, $descriptionRepository, $productPriceRepository);

        $productImageFixture = ProductImageFixture::image(25413234);
        $productImages[$productId][] = $productImageFixture;
        $productImagesService = $this->createMock(ProductImagesService::class);
        $productImagesService->expects($this->any())
            ->method('getProductsImagesByProductIds')
            ->willReturn($productImages);


        $productCategoryFixture = ProductCategoryFixture::category($productId);
        $productCategories[$productId] = $productCategoryFixture;
        $productCategoriesService = $this->createMock(ProductCategoriesService::class);
        $productCategoriesService->expects($this->any())
            ->method('getProductCategoriesByProductIds')
            ->willReturn($productCategories);

        $productService = new ProductsService($objectManagers, $container->get(ProductEntityMapper::class), $productImagesService, $productCategoriesService);
        $productsCollection = $productService->getProductsByIds([$productId]);

        $productsAssertsCheckerTest = new ProductsAssertsChecker();
        $productsAssertsCheckerTest->checkAssertsProducts($productsCollection, $productFixture, $productCategoryFixture, $productDescriptionFixture, $productPriceFixture, $productImageFixture, 'Samsung');
    }
}
