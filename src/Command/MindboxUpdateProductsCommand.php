<?php

declare(strict_types=1);

namespace App\Command;

use App\MindboxMessages\Csv\Products\ExportProductsMindboxMessageCsv;
use App\Repository\Mindbox\ExportProductsRepository;
use App\Service\MindboxApiClient\MindboxApiClient;
use App\Service\ProductServices\ProductsService;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\Exception as DoctrineDbalException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MindboxUpdateProductsCommand extends Command
{
    private const NUMBER_OF_PRODUCTS_PER_SERVING_FOR_DATABASE = 500;

    protected static $defaultName = 'mindbox:update-products';
    protected static $defaultDescription = 'Update products in mindbox service';

    private ExportProductsRepository $exportProductsRepository;
    private ProductsService $productsService;
    private MindboxApiClient $mindboxApiClient;
    private LoggerInterface $logger;

    public function __construct(
        ExportProductsRepository $exportProductsRepository,
        ProductsService          $productsService,
        MindboxApiClient         $mindboxApiClient,
        LoggerInterface          $logger
    ) {
        $this->exportProductsRepository = $exportProductsRepository;
        $this->productsService = $productsService;
        $this->mindboxApiClient = $mindboxApiClient;
        $this->logger = $logger;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->logger->info(sprintf('Start export products %s', (new DateTime())->format(DateTimeInterface::ATOM)));

        $startTime = microtime(true);

        $io = new SymfonyStyle($input, $output);

        $exportProductsCollections = $this->exportProductsRepository->findAll();

        if (empty($exportProductsCollections)) {
            $io->caution('Non found export products in export_products table');
            return Command::SUCCESS;
        }

        $productIds = [];
        foreach ($exportProductsCollections as $exportProducts) {
            foreach ($exportProducts->getProductsIds() as $productsId) {
                $productIds[$productsId] = $productsId;
            }
        }

        try {
            $productCounts = 0;
            $productsCollections = [];

            foreach (array_chunk($productIds, self::NUMBER_OF_PRODUCTS_PER_SERVING_FOR_DATABASE) as $chunkIds) {
                $productsCollection = $this->productsService->getProductsByIds($chunkIds);
                $productsCollections[] = $productsCollection;
                $productCounts += $productsCollection->count();
            }

            $result = $this->mindboxApiClient->post(new ExportProductsMindboxMessageCsv($productsCollections));

            if ($result->isStatusOk() === true) {
                $count = 0;
                foreach ($exportProductsCollections as $exportProduct) {
                    $count++;
                    $this->exportProductsRepository->remove($exportProduct, $count === count($exportProductsCollections));
                }
            }

        } catch (Exception|DoctrineDbalException|GuzzleException|OptimisticLockException|ORMException $e) {
            $io->error($e->getMessage());
            $this->logger->error($e->getMessage());

            return Command::INVALID;
        }

        $finishTime = microtime(true);
        $deltaTime = $finishTime - $startTime;

        $this->logger->info(sprintf('Export time %d', $deltaTime));
        $this->logger->info(sprintf('Products count %d', $productCounts));
        $this->logger->info(sprintf('Stop export products %s', (new DateTime())->format(DateTimeInterface::ATOM)));

        $io->info(sprintf('Export time %d', $deltaTime));
        $io->info(sprintf('Products count %d', $productCounts));
        $io->success('ExportProduct updated in mindbox service.');

        return Command::SUCCESS;
    }
}
