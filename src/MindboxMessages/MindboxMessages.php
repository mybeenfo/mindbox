<?php

declare(strict_types=1);

namespace App\MindboxMessages;

interface MindboxMessages
{
    const DEVICE_UID = '8350e5a3e24c153df2275c9f80692773';

    public function apiUrl(): string;
    public function headers(): array;
    public function queryParams(): array;
    public function body(): string;
}