<?php

declare(strict_types=1);

namespace App\Tests\Unit\DTO;

use App\DTO\ExportProduct;
use App\Entity\Monolith\ProductCategory;
use PHPUnit\Framework\TestCase;

class ExportProductTest extends TestCase
{
    private ExportProduct $exportProduct;

    protected function setUp(): void
    {
        $this->exportProduct = new ExportProduct();
    }

    public function testId()
    {
        $this->exportProduct->setId(1);
        $id = $this->exportProduct->getId();
        $this->assertIsInt($id);
        $this->assertEquals(1, $id);
    }

    public function testCategory()
    {
        $productCategory = $this->createMock(ProductCategory::class)
            ->setCategoryId(1)
            ->setLinkType('M')
            ->setCategoryName('Телевизоры');

        $this->exportProduct->setCategory(null);
        $this->exportProduct->setCategory($productCategory);
        $exportProductCategory = $this->exportProduct->getCategory();

        $this->assertInstanceOf(ProductCategory::class, $exportProductCategory);
    }

    public function testName()
    {
        $productName = 'Телевизор LG';

        $this->exportProduct->setName($productName);
        $exportProductName = $this->exportProduct->getName();

        $this->assertIsString($exportProductName);
        $this->assertEquals($productName, $exportProductName);
    }

    public function testDescription()
    {
        $description = 'Диагональ 15"';

        $this->exportProduct->setDescription(null);
        $this->exportProduct->setDescription($description);
        $exportProductDescription = $this->exportProduct->getDescription();

        $this->assertIsString($exportProductDescription);
        $this->assertEquals($description, $exportProductDescription);
    }

    public function testPrice()
    {
        $price = 1000.50;

        $this->exportProduct->setPrice($price);
        $exportProductPrice = $this->exportProduct->getPrice();

        $this->assertIsFloat($exportProductPrice);
        $this->assertEquals($price, $exportProductPrice);
    }

    public function testUrl()
    {
        $productId = 1;
        $siteHost = 'https://cdek.market/';
        $alias = 'lcd-televizor-lg';

        $urlOne = sprintf('%s/p/%s/%s', $siteHost, $productId, !empty($alias) ? $alias . '/' : '');
        $this->exportProduct->setUrl($productId, $siteHost, $alias);
        $urlResultOne = $this->exportProduct->getUrl();

        $this->assertIsString($urlResultOne);
        $this->assertEquals($urlOne, $urlResultOne);
    }

    public function testImages()
    {
        $images = [
            'https://static.cdek.market/images/market/fw/2143/1500/04a880b744846b1921e35442e319354e.jpg'
        ];

        $this->exportProduct->setImages($images);
        $exportProductImages = $this->exportProduct->getImages();
        $this->assertEquals($images, $exportProductImages);
    }

    public function testVendor()
    {
        $vendor = 'Samsung';

        $this->exportProduct->setVendor(null);
        $this->exportProduct->setVendor($vendor);

        $exportProductVendor = $this->exportProduct->getVendor();
        $this->assertEquals($vendor, $exportProductVendor);
    }

    public function testAmount()
    {
        $amount = 10;

        $this->exportProduct->setAmount($amount);

        $exportProductAmount = $this->exportProduct->getAmount();
        $this->assertEquals($amount, $exportProductAmount);
    }
}