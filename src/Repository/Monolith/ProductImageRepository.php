<?php

declare(strict_types=1);

namespace App\Repository\Monolith;

use App\Entity\Monolith\ProductImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method ProductImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductImage[]    findAll()
 * @method ProductImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductImageRepository extends ServiceEntityRepository
{
    /**
     * Шаблон ссылки на изображение в старом хранилище.
     */
    private string $oldImageTemplate;

    /**
     * Шаблон ссылки на изображение в pics-store.
     */
    private string $newImageTemplate;

    public function __construct(ManagerRegistry $registry, string $oldImageTemplate, string $newImageTemplate)
    {
        $this->oldImageTemplate = $oldImageTemplate;
        $this->newImageTemplate = $newImageTemplate;

        parent::__construct($registry, ProductImage::class);
    }

    /**
     * @param array $ids
     * @return array
     * @throws Exception
     */
    public function findByIds(array $ids): array
    {
        if (0 === count($ids)) {
            return [];
        }

        $images = $this->createQueryBuilder('productImage', 'productImage.imageId')
            ->where('productImage.imageId IN (:ids)')
            ->setParameter('ids', $ids)
            ->andWhere("productImage.imagePath != ''")
            ->getQuery()
            ->getResult();

        foreach ($images as $image) {
            /* @var ProductImage $image */
            $image->setImageUrl($this->getImageUrl($image->getImageId(), $image->getImagePath()));
        }

        return $images;
    }

    /**
     * Возвращает ссылку на изображение.
     * @throws Exception
     */
    protected function getImageUrl(?int $imageId, string $imageUrl): string
    {
        if (0 === mb_strpos($imageUrl, 'PIC_')) {
            return $this->getImageUrlNew($imageId, $imageUrl);
        }

        return $this->getImageUrlOld($imageId, $imageUrl);
    }

    /**
     * Возвращает ссылку на изображение в pics-store.
     *
     * @param int|null $imageId
     * @param string $imageUrl
     * @return string
     * @throws Exception
     */
    protected function getImageUrlNew(?int $imageId, string $imageUrl): string
    {
        $delimiter = '_';
        $service = 'market';
        $imageInfo = explode($delimiter, $imageUrl);

        if (4 !== count($imageInfo)) {
            throw new Exception("Нарушен формат имени изображения #$imageId");
        }

        $imageName = &$imageInfo[3];

        return sprintf($this->newImageTemplate, $service, $imageName);
    }

    /**
     * Возвращает ссылку на изображение в старом хранилище.
     */
    protected function getImageUrlOld(?int $imageId, string $imageName): string
    {
        $path = floor($imageId / 1000);

        return sprintf($this->oldImageTemplate, $path, $imageName);
    }
}
