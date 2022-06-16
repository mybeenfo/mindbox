<?php

declare(strict_types=1);

namespace App\Service\UserServices;

use App\Exceptions\ApiResponseException;
use App\Repository\Monolith\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Psr\Log\LoggerInterface;

class UserService
{
    private UserRepository $userRepository;
    private LoggerInterface $logger;

    public function __construct(UserRepository $userRepository, LoggerInterface $logger)
    {
        $this->userRepository = $userRepository;
        $this->logger = $logger;
    }

    /**
     * @throws ApiResponseException
     */
    public function getPhoneByUserId(int $userId): string
    {
        try {
            return $this->userRepository->getPhoneByUserId($userId);
        } catch (NoResultException|NonUniqueResultException $e) {
            $this->logger->error($e->getMessage());
            throw new ApiResponseException('CUSTOMER_NOT_FOUND');
        }
    }
}