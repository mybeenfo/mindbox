<?php

declare(strict_types=1);

namespace App\MindboxMessages\Csv;

abstract class ExportMindboxMessagesCsv
{
    const COL_DELIMITER = ';';
    const ROW_DELIMITER = "\r\n";
    const HEADERS = [
        'Content-Type'  => 'text/csv;charset=utf-8',
    ];
}