<?php

namespace App\Controller;

use App\Services\ProductCardServices;
use Exception;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductCardController extends AbstractController
{
    public function __construct(private readonly ProductCardServices $productCardServices) {}

    public function testMessage(): JsonResponse
    {
        try {
            $testMsg = $this->productCardServices->testServiceMessage();
            return $this->json([
                "message" => $testMsg,
            ]);
        } catch (Exception $e) {
            return $this->json([
                "message" => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        }
    }

    public function create(Request $req): JsonResponse
    {
        try {
            $testMsg = $this->productCardServices->create($req);
            return $this->json([
                "message" => $testMsg,
            ]);
        } catch (Exception $e) {
            return $this->json([
                "message" => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        }
    }
}