<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\Entity\Monolith\ProductImage;

class ProductImageFixture
{
    public static function image(int $imageId): ProductImage
    {
        return (new ProductImage())
            ->setImageId($imageId)
            ->setImagePath('3-4.jpg')
            ->setImageUrl('https://cdek.market/images/detailed/25413/3-4.jpg');
    }
}