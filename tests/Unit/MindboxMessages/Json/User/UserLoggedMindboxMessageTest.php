<?php

declare(strict_types=1);

namespace App\Tests\Unit\MindboxMessages\Json\User;

use App\MindboxMessages\Json\User\UserLoggedMindboxMessage;
use App\Tests\Fixtures\UserFixture;
use PHPUnit\Framework\TestCase;

class UserLoggedMindboxMessageTest extends TestCase
{
    public function testBody(): void
    {
        $user = UserFixture::user();

        $userFixture = [
            'customer' => [
                'ids' => [
                    'websiteID' => $user->getUserId(),
                ],
            ]
        ];

        $userLoggedMindboxMessage = new UserLoggedMindboxMessage($user);
        $this->assertEquals(json_encode($userFixture), $userLoggedMindboxMessage->body());
    }
}