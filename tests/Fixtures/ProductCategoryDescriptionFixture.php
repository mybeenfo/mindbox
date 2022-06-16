<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\Entity\Monolith\ProductCategoryDescription;

class ProductCategoryDescriptionFixture
{
    public static function categoryDescription(int $categoryId): ProductCategoryDescription
    {
        return (new ProductCategoryDescription())
            ->setCategoryId($categoryId)
            ->setCategory('Электроника');
    }
}