<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

use App\Entity\Monolith\User;

class UserFixture
{
    public static function user(): User
    {
        return (new User())
            ->setUserId(1)
            ->setEmail('example@mail.com')
            ->setPhone('79999999999')
            ->setFirstname('Ivan')
            ->setLastname('Ivanov');

    }
}