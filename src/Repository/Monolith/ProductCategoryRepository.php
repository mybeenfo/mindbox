<?php

declare(strict_types=1);

namespace App\Repository\Monolith;

use App\Entity\Monolith\ProductCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductCategory[]    findAll()
 * @method ProductCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductCategory::class);
    }

    public function getCategoriesByIds(array $ids): array
    {
        if (0 === count($ids)) {
            return [];
        }

        return $this->createQueryBuilder('productCategory')
            ->where('productCategory.productId IN (:ids)')
            ->setParameter('ids', $ids)
            ->andWhere('productCategory.linkType = :linkType')
            ->setParameter('linkType', 'M')
            ->getQuery()
            ->getResult();
    }
}
