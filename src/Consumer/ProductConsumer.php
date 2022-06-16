<?php

declare(strict_types=1);

namespace App\Consumer;

use App\Entity\Mindbox\ExportProducts;
use App\Repository\Mindbox\ExportProductsRepository;
use Market\MessageBus\Messages\ProductUpdatedMessage;
use Market\MessageBus\MessagesFactory;
use OldSound\RabbitMqBundle\RabbitMq\BatchConsumerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * Class ProductConsume.
 *
 * @project mindbox
 **/
class ProductConsumer implements ConsumerInterface, BatchConsumerInterface
{
    private MessagesFactory $messagesFactory;
    private ExportProductsRepository $exportProductsRepository;
    private LoggerInterface $logger;

    public function __construct(
        MessagesFactory          $messagesFactory,
        ExportProductsRepository $exportProductsRepository,
        LoggerInterface          $logger
    ) {
        $this->messagesFactory = $messagesFactory;
        $this->exportProductsRepository = $exportProductsRepository;
        $this->logger = $logger;
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

            if (!empty($message->productIds)) {
                $exportProduct = new ExportProducts();
                $exportProduct->setProductsIds($message->productIds);
                $this->exportProductsRepository->add($exportProduct);
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
