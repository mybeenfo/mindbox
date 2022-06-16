<?php

declare(strict_types=1);

namespace App\MindboxMessages\Csv\Products;

use App\DTO\ExportProduct;
use App\Entity\Monolith\ProductImage;
use App\MindboxMessages\Csv\ExportMindboxMessagesCsv;
use App\MindboxMessages\MindboxMessages;

class ExportProductsMindboxMessageCsv extends ExportMindboxMessagesCsv implements MindboxMessages
{

    private const API_URL = 'v3/operations/bulk';

    private array $productsCollections;

    public function __construct(array $productsCollections)
    {
        $this->productsCollections = $productsCollections;
    }

    public function apiUrl(): string
    {
        return self::API_URL;
    }

    public function headers(): array
    {
        return self::HEADERS;
    }

    public function queryParams(): array
    {
        return [
            'operation'      => 'ImportProducts',
            'csvCodePage'    => 65001,
            'externalSystem' => 'MarketProductID',
        ];
    }

    public function body(): string
    {
        $headerArray = [
            'Name',
            'MarketProductID',
            'CategoriesMarketProductID',
            'PictureUrl',
            'IsAvailable',
            'Price',
            'Url',
            'BrandSystemName',
        ];

        $bodyStr = implode(self::COL_DELIMITER, $headerArray) . self::ROW_DELIMITER;

        foreach ($this->productsCollections as $productsCollection) {
            foreach ($productsCollection as $product) {
                $imageUrl = '';
                foreach ($product->getImages() as $image) {
                    /** @var ProductImage $image */
                    $imageUrl = urlencode($image->getImageUrl());
                }

                /** @var ExportProduct $product */
                $productArray = [
                    'name'                          => $product->getName(),
                    'MarketProductID'           => $product->getId(),
                    'categoriesMarketProductID' => null !== $product->getCategory() ? $product->getCategory()->getCategoryId() : '',
                    'pictureUrl'                    => $imageUrl,
                    'isAvailable'                   => $product->getAmount() > 0 ? '1' : '0',
                    'price'                         => $product->getPrice(),
                    'url'                           => urlencode($product->getUrl()),
                    'brandSystemName'               => 'cdek-market',
                ];

                $bodyStr .= implode(self::COL_DELIMITER, $productArray) . self::ROW_DELIMITER;
            }
        }

        return $bodyStr;
    }
}