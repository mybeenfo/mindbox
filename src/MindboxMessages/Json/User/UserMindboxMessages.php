<?php

declare(strict_types=1);

namespace App\MindboxMessages\Json\User;

use App\Entity\Monolith\User;
use App\MindboxMessages\Json\JsonMindboxMessages;

abstract class UserMindboxMessages extends JsonMindboxMessages
{
    const API_URL = 'v3/operations/async';

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function apiUrl(): string
    {
        return self::API_URL;
    }

    public function headers(): array
    {
        return self::HEADERS;
    }
}