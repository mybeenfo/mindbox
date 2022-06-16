<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\Entity\Monolith\Product;

class ProductFixture
{
    public static function product(int $productId): Product
    {
        return (new Product())
            ->setProductId($productId)
            ->setCdekSeoName('lcd-televizor-lg')
            ->setAmount(1);
    }
}