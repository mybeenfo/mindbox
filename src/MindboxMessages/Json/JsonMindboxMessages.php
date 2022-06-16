<?php

declare(strict_types=1);

namespace App\MindboxMessages\Json;

abstract class JsonMindboxMessages
{
    protected const HEADERS = [
        'Content-Type'  => 'application/json; charset=utf-8',
    ];
}