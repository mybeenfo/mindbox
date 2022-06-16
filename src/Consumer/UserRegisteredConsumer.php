<?php

declare(strict_types=1);

namespace App\Consumer;

use App\Entity\Monolith\User;
use App\Exceptions\UserConsumersException;
use App\MindboxMessages\Json\User\UserRegisteredMindboxMessage;
use App\Service\MindboxApiClient\MindboxApiClient;
use App\Service\ProductServices\ProductsService;
use Market\MessageBus\Messages\ProductUpdatedMessage;
use Market\MessageBus\MessagesFactory;
use Doctrine\Persistence\ManagerRegistry;
use GuzzleHttp\Exception\GuzzleException;
use OldSound\RabbitMqBundle\RabbitMq\BatchConsumerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * Class UserRegisteredConsumer.
 *
 * @project mindbox
 **/
class UserRegisteredConsumer implements ConsumerInterface, BatchConsumerInterface
{
    private MessagesFactory $messagesFactory;
    private ManagerRegistry $doctrine;
    private LoggerInterface $logger;
    private MindboxApiClient $mindboxApiClient;

    public function __construct(
        MessagesFactory  $messagesFactory,
        ManagerRegistry  $doctrine,
        LoggerInterface  $logger,
        MindboxApiClient $mindboxApiClient
    ) {
        $this->messagesFactory = $messagesFactory;
        $this->doctrine = $doctrine;
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
                $user = $this->doctrine
                    ->getRepository(User::class, ProductsService::MONOLITH_ENTITY_MANAGER)
                    ->getUserById($message->userId);

                $result = $this->mindboxApiClient->post(new UserRegisteredMindboxMessage($user));

                $this->logger->info('User registered in mindbox service', [
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
