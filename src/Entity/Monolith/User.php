<?php

declare(strict_types=1);

namespace App\Entity\Monolith;

use App\Repository\Monolith\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="cscart_users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $userId;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private string $phone;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private string $lastname;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private string $isPhoneConfirmed;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return User
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsPhoneConfirmed(): string
    {
        return $this->isPhoneConfirmed;
    }

    /**
     * @param string $isPhoneConfirmed
     * @return User
     */
    public function setIsPhoneConfirmed(string $isPhoneConfirmed): self
    {
        $this->isPhoneConfirmed = $isPhoneConfirmed;

        return $this;
    }


}