<?php

declare(strict_types=1);

namespace App\Repository\Monolith;

use App\Entity\Monolith\ProductPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductPrice[]    findAll()
 * @method ProductPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductPrice::class);
    }

    public function getPricesByIds(array $ids): array
    {
        if (0 === count($ids)) {
            return [];
        }

        $prices = $this->createQueryBuilder('productPrice')
            ->where('productPrice.productId IN (:ids)')
            ->setParameter('ids', $ids)
            ->andWhere('productPrice.lowerLimit = :lowerLimit')
            ->setParameter('lowerLimit', 1)
            ->andWhere('productPrice.usergroupId = :userGroupId')
            ->setParameter('userGroupId', 0)
            ->getQuery()
            ->getResult();

        $resultPrices = [];
        foreach ($prices as $price) {
            /** @var ProductPrice $price */
            $productId = $price->getProductId();
            if (!isset($resultPrices[$productId])) {
                $resultPrices[$productId] = $price;
            }
        }

        return $resultPrices;
    }
}
