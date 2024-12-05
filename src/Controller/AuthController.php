<?php

namespace App\Controller;

use Exception;
use App\Services\AuthServices;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthController extends AbstractController
{
    public function __construct(private readonly AuthServices $authService) {}

    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AuthController.php',
        ]);
    }

    public function getUserInfo(Security $security)
    {
        try {
            $user = $this->authService->getUserInfo($security);
            return $this->json([
                "user" => $user
            ]);
        } catch (Exception $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "code" => $e->getCode()
            ], 400);
        }
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $data = $this->authService->register($request);
            return $this->json($data);
        } catch (Exception $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "code" => $e->getCode()
            ], 400);
        }
    }

    public function logout(Security $security)
    {
        try {
            $result =  $this->authService->logout($security);
            return $this->json($result);
        } catch (Exception $e) {
            return $this->json([
                "msg" => $e->getMessage(),
                "code" => $e->getCode()
            ], 400);
        }
    }
}