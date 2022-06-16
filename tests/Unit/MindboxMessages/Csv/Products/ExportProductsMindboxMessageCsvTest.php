<?php

declare(strict_types=1);

namespace App\Tests\Unit\MindboxMessages\Csv\Products;

use App\MindboxMessages\Csv\Products\ExportProductsMindboxMessageCsv;
use App\Tests\Fixtures\ExportProductFixture;
use PHPUnit\Framework\TestCase;

class ExportProductsMindboxMessageCsvTest extends TestCase
{
    public function testBody(): void
    {
        $messageBody = "Name;MarketProductID;CategoriesMarketProductID;PictureUrl;IsAvailable;Price;Url;BrandSystemName\r\nТовар 694162;694162;306;https%3A%2F%2Fcdek.market%2Fimages%2Fdetailed%2F25413%2F3-4.jpg;1;150.5;https%3A%2F%2Fcdek.market%2Fp%2F694162%2Flcd-televizor-samsung%2F;cdek-market\r\n";

        $exportProduct[][] = ExportProductFixture::exportProducts(694162);
        $exportProductsMessageCsv = new ExportProductsMindboxMessageCsv($exportProduct);
        $body = $exportProductsMessageCsv->body();

        $this->assertEquals($messageBody, $body);
    }
}