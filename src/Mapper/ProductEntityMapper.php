<?php

declare(strict_types=1);

namespace App\Mapper;

use App\DTO\ExportProduct;
use App\Entity\Monolith\Product;
use App\Entity\Monolith\ProductCategory;
use App\Entity\Monolith\ProductDescription;
use App\Entity\Monolith\ProductPrice;
use App\Repository\Monolith\ProductDescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;

class ProductEntityMapper
{
    private string $MarketHost;

    protected ?ExportProduct $prototype = null;

    public function __construct(string $MarketHost)
    {
        $this->MarketHost = $MarketHost;
    }

    /**
     * Коллекция товаров
     *
     * @param array $products
     * @param array $productCategories
     * @param array $descriptions
     * @param array $prices
     * @param array $images
     * @return ArrayCollection
     */
    public function entityCollectionFromService(
        array $products,
        array $productCategories,
        array $descriptions,
        array $prices,
        array $images
    ): ArrayCollection {
        $collection = new ArrayCollection();

        foreach ($products as $product) {
            $productId = $product->getProductId();

            if (empty($prices[$productId]) || $prices[$productId]->getPrice() == 0) {
                continue;
            }

            if (empty($descriptions[$productId]) || empty($descriptions[$productId]->getProduct())) {
                continue;
            }

            $collection->add(
                $this->entityFromService(
                    $product,
                    $prices[$productId],
                    $descriptions[$productId],
                    $productCategories[$productId] ?? null,
                    $images[$productId] ?? []
                )
            );
        }

        return $collection;
    }

    /**
     * @param Product $product
     * @param ProductPrice $price
     * @param ProductDescription|null $description
     * @param ProductCategory|null $productCategory
     * @param array|null $images
     * @return ExportProduct
     */
    public function entityFromService(
        Product            $product,
        ProductPrice       $price,
        ProductDescription $description,
        ?ProductCategory   $productCategory,
        ?array             $images
    ): ExportProduct {
        $productId = $product->getProductId();

        $entity = $this->getPrototype();
        $entity->setId($productId);
        $entity->setCategory($productCategory);
        $entity->setName($description->getProduct());
        $entity->setPrice($price->getPrice());
        $entity->setUrl($productId, $this->MarketHost, $product->getCdekSeoName());
        $entity->setImages($images);
        $entity->setAmount($product->getAmount());
        $entity->setDescription($description->getFullDescription());

        $vendor = $description->getCdekFeaturesJson()[ProductDescriptionRepository::BRAND_FEATURE_ID]['values'][0] ?? null;
        $entity->setVendor($vendor);

        return $entity;
    }

    /**
     * @return ExportProduct
     */
    private function getPrototype(): ExportProduct
    {
        if (null === $this->prototype) {
            $this->prototype = new ExportProduct();
        }

        return clone $this->prototype;
    }
}