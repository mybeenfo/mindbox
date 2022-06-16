<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\Entity\Monolith\ProductImageLink;

class ProductImageLinkFixture
{
    public static function imageLink(int $productId): ProductImageLink
    {
        return (new ProductImageLink())
            ->setObjectId($productId)
            ->setImageId(25413234)
            ->setObjectType('product')
            ->setType('M')
            ->setPairId(28664265);
    }
}