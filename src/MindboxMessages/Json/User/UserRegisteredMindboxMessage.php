<?php

declare(strict_types=1);

namespace App\MindboxMessages\Json\User;

use App\MindboxMessages\MindboxMessages;

class UserRegisteredMindboxMessage extends UserMindboxMessages implements MindboxMessages
{
    public function queryParams(): array
    {
        return [
            'operation' => urlencode('WebsiteCM.RegisterCustomer'),
            'deviceUUID' => self::DEVICE_UID,
        ];
    }

    public function body(): string
    {
        $user = [
            'customer' => [
                'mobilePhone' => $this->user->getPhone(),
                'email' => $this->user->getEmail(),
                'ids' => [
                    'websiteID' => $this->user->getUserId()
                ],
                'lastName' => $this->user->getLastname(),
                'firstName' => $this->user->getFirstname(),
            ]
        ];

        return json_encode($user);
    }
}