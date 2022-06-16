<?php

declare(strict_types=1);

namespace App\MindboxMessages\Json\User;

use App\MindboxMessages\MindboxMessages;

class UserLoggedMindboxMessage extends UserMindboxMessages implements MindboxMessages
{
    public function queryParams(): array
    {
        return [
            'operation' => urlencode('WebsiteCM.AuthorizeCustomer'),
            'deviceUUID' => self::DEVICE_UID,
        ];
    }

    public function body(): string
    {
        $user = [
            'customer' => [
                'ids' => [
                    'websiteID' => $this->user->getUserId(),
                ],
            ]
        ];

        return json_encode($user);
    }
}