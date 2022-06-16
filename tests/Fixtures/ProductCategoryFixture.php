<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\Entity\Monolith\ProductCategory;

class ProductCategoryFixture
{
    public static function category(int $productId): ProductCategory
    {
        return (new ProductCategory())
            ->setProductId($productId)
            ->setCategoryId(306)
            ->setCategoryName('Электроника')
            ->setLinkType('M');
    }
}