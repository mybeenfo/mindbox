<?php

declare(strict_types=1);

namespace App\Consumer;

use App\Entity\Monolith\User;
use App\Exceptions\UserConsumersException;
use App\MindboxMessages\Json\User\UserLoggedMindboxMessage;
use App\Service\MindboxApiClient\MindboxApiClient;
use Market\MessageBus\Messages\ProductUpdatedMessage;
use Market\MessageBus\MessagesFactory;
use GuzzleHttp\Exception\GuzzleException;
use OldSound\RabbitMqBundle\RabbitMq\BatchConsumerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * Class UserLoggedConsumer.
 *
 * @project mindbox
 **/
class UserLoggedConsumer implements ConsumerInterface, BatchConsumerInterface
{
    private MessagesFactory $messagesFactory;
    private LoggerInterface $logger;
    private MindboxApiClient $mindboxApiClient;

    public function __construct(
        MessagesFactory  $messagesFactory,
        LoggerInterface  $logger,
        MindboxApiClient $mindboxApiClient
    ) {
        $this->messagesFactory = $messagesFactory;
        $this->logger = $logger;
        $this->mindboxApiClient = $mindboxApiClient;
    }

    /**
     * {@inheritDoc}
     */
    public function batchExecute(array $messages)
    {
        foreach ($messages as $message) {
            $this->execute($message);
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(AMQPMessage $msg)
    {
        try {
            $this->logger->info('Moderation consumer get a message from the queue', [
                'class'       => __CLASS__,
                'raw_message' => $msg->getBody(),
            ]);

            /** @var ProductUpdatedMessage $message */
            $message = $this->messagesFactory->create($msg->getBody());

            if (empty($message->userId)) {
                throw new UserConsumersException('PARAMETER_USER_ID_IS_EMPTY');
            }

            try {
                $user = new User;
                $user->setUserId($message->userId);

                $result = $this->mindboxApiClient->post(new UserLoggedMindboxMessage($user));

                $this->logger->info('User logged in mindbox service', [
                    'class'       => __CLASS__,
                    'raw_message' => $result->getResponseStrContents(),
                ]);
            } catch (GuzzleException $e) {
                $this->logger->error($e->getMessage());
            }

        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage(), [
                'class'       => __CLASS__,
                'raw_message' => $msg->getBody(),
                'exception'   => $exception,
            ]);
        }

        return self::MSG_ACK;
    }
}
