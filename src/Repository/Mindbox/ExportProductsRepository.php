<?php

declare(strict_types=1);

namespace App\Repository\Mindbox;

use App\Entity\Mindbox\ExportProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExportProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExportProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExportProducts[]    findAll()
 * @method ExportProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExportProductsRepository extends ServiceEntityRepository
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $registry)
    {
        $this->doctrine = $registry;
        parent::__construct($registry, ExportProducts::class);
    }

    /**
     * @param ExportProducts $entity
     */
    public function add(ExportProducts $entity)
    {
        $em = $this->doctrine->resetManager();
        $em->persist($entity);
        $em->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ExportProducts $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}