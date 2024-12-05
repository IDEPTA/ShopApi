<?php

namespace App\Services;

use App\Repository\ProductCardRepository;
use Symfony\Component\HttpFoundation\Request;

class ProductCardServices
{

    public function __construct(
        private readonly ProductCardRepository $productCardRepository
    ) {}

    public function testServiceMessage()
    {
        return "is worked";
    }

    public function create(Request $req)
    {
        // Декодируем JSON в массив
        $data = json_decode($req->getContent(), true);

        $product = $this->productCardRepository->create($data);

        return $product;
    }
}