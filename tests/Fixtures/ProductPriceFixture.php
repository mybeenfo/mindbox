<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\Entity\Monolith\ProductPrice;

class ProductPriceFixture
{
    public static function price($productId): ProductPrice
    {
        return (new ProductPrice())
            ->setProductId($productId)
            ->setPrice(2299.5)
            ->setLowerLimit(1)
            ->setUsergroupId(0);
    }
}