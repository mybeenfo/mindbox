<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\ProductServices;

use App\Entity\Monolith\ProductImage;
use App\Repository\Monolith\ProductImageLinkRepository;
use App\Repository\Monolith\ProductImageRepository;
use App\Service\ProductServices\ProductImagesService;
use App\Tests\Fixtures\ProductImageFixture;
use App\Tests\Fixtures\ProductImageLinkFixture;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;


class ProductImagesServiceTest extends TestCase
{
    public function testGetProductsImagesByProductIds()
    {
        $productId = 8627474;
        $imageId = 25413234;

        $imageLinkFixture = ProductImageLinkFixture::imageLink($productId);
        $imageLinks[$productId][] = $imageLinkFixture;
        $productImageLinkRepository = $this->createMock(ProductImageLinkRepository::class);
        $productImageLinkRepository->expects($this->any())
            ->method('findByType')
            ->willReturn($imageLinks);

        $imageFixture = ProductImageFixture::image($imageId);
        $images[$imageId] = $imageFixture;
        $productImageRepository = $this->createMock(ProductImageRepository::class);
        $productImageRepository->expects($this->any())
            ->method('findByIds')
            ->willReturn($images);

        $objectManager = $this->createMock(ManagerRegistry::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturnOnConsecutiveCalls($productImageLinkRepository, $productImageRepository);

        $productImagesService = new ProductImagesService($objectManager);
        $productsImagesResult = $productImagesService->getProductsImagesByProductIds([$productId]);
        $productsImageResult = $productsImagesResult[$productId][0];

        $this->assertIsArray($productsImagesResult);
        $this->assertInstanceOf(ProductImage::class, $productsImageResult);
        $this->assertIsInt($productsImageResult->getImageId());
        $this->assertEquals('https://cdek.market/images/detailed/25413/3-4.jpg', $productsImageResult->getImageUrl());
        $this->assertEquals($imageFixture, $productsImageResult);
    }
}
