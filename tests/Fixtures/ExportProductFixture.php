<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\DTO\ExportProduct;

class ExportProductFixture
{
    public static function exportProducts(int $productId): ExportProduct
    {
        $exportProduct = new ExportProduct();
        $exportProduct->setId($productId);
        $exportProduct->setCategory(ProductCategoryFixture::category($productId));
        $exportProduct->setName('Товар ' . $productId);
        $exportProduct->setDescription('Описание товара ' . $productId);
        $exportProduct->setPrice(150.5);
        $exportProduct->setUrl($productId, 'https://cdek.market', 'lcd-televizor-samsung');
        $exportProduct->setImages([ProductImageFixture::image(25413234)]);
        $exportProduct->setVendor('Samsung');
        $exportProduct->setAmount(10);

        return $exportProduct;
    }
}