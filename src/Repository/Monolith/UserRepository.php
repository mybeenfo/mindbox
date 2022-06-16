<?php

declare(strict_types=1);

namespace App\Repository\Monolith;

use App\Entity\Monolith\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    private const IS_PHONE_CONFIRMED_CODE = 'Y';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getUserById(int $id)
    {
        return $this->createQueryBuilder('user')
            ->where('user.userId = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getPhoneByUserId(int $userId): string
    {
        $user = $this->createQueryBuilder('user')
            ->select('user.phone')
            ->where('user.userId = :id')
            ->setParameter('id', $userId)
            ->andWhere("user.phone != ''")
            ->andWhere('user.isPhoneConfirmed = :isPhoneConfirmed')
            ->setParameter('isPhoneConfirmed', self::IS_PHONE_CONFIRMED_CODE)
            ->getQuery()
            ->getSingleResult();

        return $user['phone'];
    }
}