<?php

declare(strict_types=1);

namespace App\Repository\Monolith;

use App\Entity\Monolith\ProductDescription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDescription[]    findAll()
 * @method ProductDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductDescriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDescription::class);
    }

    const BRAND_FEATURE_ID = 9;

    public function getDescriptionByIds(array $ids): array
    {
        if (0 === count($ids)) {
            return [];
        }

        $descriptions = $this->createQueryBuilder('productDescription')
            ->where('productDescription.productId IN (:ids)')
            ->setParameter('ids', $ids)
            ->andWhere('productDescription.langCode = :langCode')
            ->setParameter('langCode', 'ru')
            ->getQuery()
            ->getResult();

        $resultDescriptions = [];
        foreach ($descriptions as $description) {
            /** @var ProductDescription $description */
            $productId = $description->getProductId();
            if (!isset($resultDescriptions[$productId])) {
                $resultDescriptions[$productId] = $description;
            }
        }

        return $resultDescriptions;
    }
}
