<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\Entity\Monolith\ProductDescription;

class ProductDescriptionFixture
{
    public static function description(int $productId, string $productName, string $description, $langCode = 'ru'): ProductDescription
    {
        return (new ProductDescription())
            ->setProductId($productId)
            ->setProduct($productName)
            ->setFullDescription($description)
            ->setLangCode($langCode)
            ->setCdekFeaturesJson([
                9 => [
                    'feature_id'        => 9,
                    'position'          => 10,
                    'type'              => 'autocomplete-cscart',
                    'name'              => 'Бренд',
                    'values'            => [
                        0 => 'Samsung',
                    ],
                    'cscart_feature_id' => 5001,
                ]
            ]);
    }
}