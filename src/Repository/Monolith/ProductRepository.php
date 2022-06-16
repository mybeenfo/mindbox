<?php

declare(strict_types=1);

namespace App\Repository\Monolith;

use App\Entity\Monolith\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getProductsByIds(array $ids): array
    {
        if (0 === count($ids)) {
            return [];
        }

        $products = $this->createQueryBuilder('product')
            ->where('product.productId IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();

        $resultProducts = [];
        foreach ($products as $product) {
            /** @var Product $product */
            $productId = $product->getProductId();
            if (!isset($resultProducts[$productId])) {
                $resultProducts[$productId] = $product;
            }
        }

        return $resultProducts;
    }
}
