<?php

declare(strict_types=1);

namespace App\Repository\Monolith;

use App\Entity\Monolith\ProductImageLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductImageLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductImageLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductImageLink[]    findAll()
 * @method ProductImageLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductImageLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductImageLink::class);
    }

    /**
     * @param array $ids
     * @param string $objectType
     * @return array[] Example [productId => [ImageLink1, ImageLink2]]
     */
    public function findByType(array $ids, string $objectType): array
    {
        if (0 === count($ids)) {
            return [];
        }

        $imageLinks = $this->createQueryBuilder('productImageLinks')
            ->where('productImageLinks.objectType = :objectType')
            ->setParameter('objectType', $objectType)
            ->andWhere('productImageLinks.objectId IN (:ids)')
            ->setParameter('ids', $ids)
            ->andWhere('productImageLinks.imageId > 0')
            ->andWhere('productImageLinks.type = :type')
            ->setParameter('type', 'M')
            ->getQuery()
            ->getResult();

        $imageLinksCollections = [];
        foreach ($imageLinks as $imageLink) {
            /** @var ProductImageLink $imageLink */
            $objectId = $imageLink->getObjectId();
            $imageLinksCollections[$objectId][] = $imageLink;
        }

        return $imageLinksCollections;
    }
}
