<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Entity\ProductCard;
use App\Entity\ProductCategory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<ProductCard>
 */
class ProductCardRepository extends ServiceEntityRepository
{
    private $validator;
    private $entityManager;
    public function __construct(ManagerRegistry $registry, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        parent::__construct($registry, ProductCard::class);
    }


    public function create(array $data)
    {
        $category = $this->entityManager
            ->getRepository(ProductCategory::class)
            ->find($data['category_id']);

        if (!$category) {
            return [
                'success' => false,
                'message' => 'Категория с ID ' . $data['category_id'] . ' не найдена.',
                'status' => 404,
            ];
        }

        // Создаем объект ProductCard
        $product = new ProductCard();
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);
        $product->setAvailability($data['availability']);
        $product->setQuantity($data['quantity']);
        $product->setImages($data['images']);
        $product->setCreatedAt(Carbon::now());
        $product->setUpdatedAt(Carbon::now());
        $product->setCategory($category);

        $errors = $this->validator->validate($product);

        if (count($errors) > 0) {
            // Если ошибки есть, возвращаем их
            $errorsString = (string) $errors;
            return [
                'success' => false,
                'message' => $errorsString,
                'status' => 400,
            ];
        }

        // Сохраняем объект в базу данных
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        // Возвращаем успешный ответ
        return [
            'success' => true,
            'message' => 'Продукт успешно создан',
            'data' => $product,
            'status' => 201,
        ];
    }
    //    /**
    //     * @return ProductCard[] Returns an array of ProductCard objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProductCard
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
