<?php

declare(strict_types=1);

namespace App\Repository\Monolith;

use App\Entity\Monolith\ProductCategoryDescription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductCategoryDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductCategoryDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductCategoryDescription[]    findAll()
 * @method ProductCategoryDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductCategoryDescriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductCategoryDescription::class);
    }

    public function getCategoryDescriptionsByCategoryIds(array $categoryIds, $langCode = 'ru'): array
    {
        $categoryDescriptionsResult = [];

        $categoryDescriptions = $this->createQueryBuilder('productCategoryDescription')
            ->where('productCategoryDescription.categoryId IN (:ids)')
            ->setParameter('ids', $categoryIds)
            ->andWhere('productCategoryDescription.langCode = :langCode')
            ->setParameter('langCode', $langCode)
            ->getQuery()
            ->getResult();

        foreach ($categoryDescriptions as $categoryDescription) {
            /** @var ProductCategoryDescription $categoryDescription */
            $categoryId = $categoryDescription->getCategoryId();
            if (isset($categoryIds[$categoryId])) {
                $categoryDescriptionsResult[$categoryId] = $categoryDescription;
            }
        }

        return $categoryDescriptionsResult;
    }
}
