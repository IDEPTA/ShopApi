<?php

namespace App\Services;

use Carbon\Carbon;
use App\Entity\ProductCard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductCardServices
{

    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function testServiceMessage()
    {
        return "is worked";
    }

    public function create(Request $req)
    {
        // Декодируем JSON в массив
        $data = json_decode($req->getContent(), true);

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

        // Выполняем валидацию на объекте
        $errors = $this->validator->validate($product);

        if (count($errors) > 0) {
            // Если ошибки есть, возвращаем их
            $errorsString = (string) $errors;
            return new Response($errorsString, 400);  // Вернуть 400 статус, если есть ошибки
        }

        // Сохраняем объект в базу данных
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        // Возвращаем успешный ответ
        return new Response('Product created successfully!', 201);
    }
}