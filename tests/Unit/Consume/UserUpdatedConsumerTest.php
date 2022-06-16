<?php

declare(strict_types=1);

namespace App\Tests\Unit\Consume;

use App\Consumer\UserLoggedConsumer;
use App\Service\MindboxApiClient\MindboxApiClient;
use Market\MessageBus\Messages\UserUpdatedMessage;
use Market\MessageBus\MessagesFactory;
use PhpAmqpLib\Message\AMQPMessage;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class UserUpdatedConsumerTest extends TestCase
{
    public function testConsume(): void
    {
        $message = $this->createMock(UserUpdatedMessage::class);
        $message->userId = 1;
        $body = 'body';
        $messageFactory = $this->createMock(MessagesFactory::class);
        $messageFactory->expects($this->once())
            ->method('create')
            ->with($body)
            ->willReturn($message);

        $mindboxApiClient = $this->createMock(MindboxApiClient::class);

        $consumer = new UserLoggedConsumer($messageFactory, new NullLogger(), $mindboxApiClient);

        $messageAmpq = $this->createMock(AMQPMessage::class);
        $messageAmpq->expects($this->any())
            ->method('getBody')
            ->willReturn($body);

        $consumer->execute($messageAmpq);
    }
}