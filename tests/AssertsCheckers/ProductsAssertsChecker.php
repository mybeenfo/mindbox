<?php

declare(strict_types=1);

namespace App\Tests\AssertsCheckers;

use App\DTO\ExportProduct;
use App\Entity\Monolith\Product;
use App\Entity\Monolith\ProductCategory;
use App\Entity\Monolith\ProductDescription;
use App\Entity\Monolith\ProductImage;
use App\Entity\Monolith\ProductPrice;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ProductsAssertsChecker extends TestCase
{
    public function checkAssertsProducts(
        ArrayCollection    $productsCollection,
        Product            $productFixture,
        ProductCategory    $productCategoryFixture,
        ProductDescription $productDescriptionFixture,
        ProductPrice       $productPriceFixture,
        ProductImage       $productImageFixture,
        string             $vendor
    ): void {

        $productId = $productFixture->getProductId();

        $this->assertInstanceOf(ArrayCollection::class, $productsCollection);

        $exportProduct = $productsCollection[0];
        $this->assertInstanceOf(ExportProduct::class, $exportProduct);

        $this->assertIsInt($exportProduct->getId());
        $this->assertEquals($exportProduct->getId(), $productId);

        $this->assertInstanceOf(ProductCategory::class, $exportProduct->getCategory());
        $this->assertEquals($exportProduct->getCategory(), $productCategoryFixture);

        $this->assertEquals($exportProduct->getName(), $productDescriptionFixture->getProduct());

        $this->assertEquals($exportProduct->getDescription(), $productDescriptionFixture->getFullDescription());

        $this->assertEquals($exportProduct->getPrice(), $productPriceFixture->getPrice());

        $this->assertEquals('https://cdek.market/p/694162/lcd-televizor-lg/', $exportProduct->getUrl());

        $this->assertIsArray($exportProduct->getImages());
        $this->assertInstanceOf(ProductImage::class, $exportProduct->getImages()[0]);
        $this->assertEquals($productImageFixture, $exportProduct->getImages()[0]);

        $this->assertEquals($exportProduct->getVendor(), $vendor);

        $this->assertEquals(1, $exportProduct->getAmount());
    }
}
