<?php

declare(strict_types=1);

namespace App\Tests\Unit\MindboxMessages\Json\User;

use App\MindboxMessages\Json\User\UserRegisteredMindboxMessage;
use App\Tests\Fixtures\UserFixture;
use PHPUnit\Framework\TestCase;

class UserUpdatedMindboxMessageTest extends TestCase
{
    public function testBody(): void
    {
        $user = UserFixture::user();

        $userFixture = [
            'customer' => [
                'mobilePhone' => $user->getPhone(),
                'email' => $user->getEmail(),
                'ids' => [
                    'websiteID' => $user->getUserId()
                ],
                'lastName' => $user->getLastname(),
                'firstName' => $user->getFirstname(),
            ]
        ];

        $userRegisteredMindboxMessage = new UserRegisteredMindboxMessage($user);

        $this->assertEquals($userRegisteredMindboxMessage->body(), json_encode($userFixture));
    }
}