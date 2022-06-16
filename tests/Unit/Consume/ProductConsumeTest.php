<?php

declare(strict_types=1);

namespace App\Tests\Unit\Consume;

use App\Consumer\ProductConsumer;
use App\Entity\Mindbox\ExportProducts;
use App\Repository\Mindbox\ExportProductsRepository;
use Market\MessageBus\Messages\ProductUpdatedMessage;
use Market\MessageBus\MessagesFactory;
use PhpAmqpLib\Message\AMQPMessage;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class ProductConsumeTest extends TestCase
{
    public function testConsume(): void
    {
        $productIds = [1];
        $message = $this->createMock(ProductUpdatedMessage::class);
        $message->productIds = $productIds;
        $body = 'body';
        $messageFactory = $this->createMock(MessagesFactory::class);
        $messageFactory->expects($this->once())
            ->method('create')
            ->with($body)
            ->willReturn($message);

        $exportProducts = new ExportProducts();
        $exportProducts->setProductsIds($productIds);

        $exportProductsRepository = $this->createMock(ExportProductsRepository::class);
        $exportProductsRepository->expects($this->once())
            ->method('add')
            ->with($exportProducts);

        $consumer = new ProductConsumer($messageFactory, $exportProductsRepository, new NullLogger());

        $messageAmpq = $this->createMock(AMQPMessage::class);
        $messageAmpq->expects($this->any())
            ->method('getBody')
            ->willReturn($body);

        $consumer->execute($messageAmpq);
    }
}
