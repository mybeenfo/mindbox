<?php

declare(strict_types=1);

namespace App\Tests\Unit\Mapper;

use App\Mapper\ProductEntityMapper;
use App\Tests\AssertsCheckers\ProductsAssertsChecker;
use App\Tests\Fixtures\ProductCategoryFixture;
use App\Tests\Fixtures\ProductDescriptionFixture;
use App\Tests\Fixtures\ProductFixture;
use App\Tests\Fixtures\ProductImageFixture;
use App\Tests\Fixtures\ProductPriceFixture;
use PHPUnit\Framework\TestCase;

class ProductEntityMapperTest extends TestCase
{
    public function testEntityCollectionFromService(): void
    {
        $productId = 694162;

        $productFixture = ProductFixture::product($productId);
        $products[$productId] = $productFixture;

        $productCategoryFixture = ProductCategoryFixture::category($productId);
        $productCategories[$productId] = $productCategoryFixture;

        $productDescriptionFixture = ProductDescriptionFixture::description($productId, 'Товар 8627474', 'Описание товара');
        $productDescriptions[$productId] = $productDescriptionFixture;

        $productPriceFixture = ProductPriceFixture::price($productId);
        $productPrices[$productId] = $productPriceFixture;

        $productImageFixture = ProductImageFixture::image(25413234);
        $productImages[$productId][] = $productImageFixture;

        $productEntityMapper = new ProductEntityMapper('https://cdek.market');
        $productsCollection = $productEntityMapper->entityCollectionFromService($products, $productCategories, $productDescriptions, $productPrices, $productImages);

        $productsAssertsCheckerTest = new ProductsAssertsChecker();
        $productsAssertsCheckerTest->checkAssertsProducts($productsCollection, $productFixture, $productCategoryFixture, $productDescriptionFixture, $productPriceFixture, $productImageFixture, 'Samsung');
    }
}
