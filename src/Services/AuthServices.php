<?php

namespace App\Services;

use Exception;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthServices
{

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly JWTTokenManagerInterface $JWTmanager,
        private readonly SerializerInterface $serializer
    ) {}

    public function getUserInfo(Security $security)
    {
        $user = $security->getUser();
        if ($user instanceof User) {
            // Автоматическая сериализация объекта пользователя в формат JSON
            $data = $this->serializer->normalize($user, null, ['groups' => 'user:read']);
            return $data;
        }
        throw new Exception("Токен не действителен", 401);
    }

    public function register(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $newUser = $this->userRepository->register($data);
        $token = $this->JWTmanager->create($newUser);
        return [
            "msg" => "Токен успешно создан",
            "toke" => $token
        ];
    }

    public function logout(Security $security)
    {
        $security->logout();
        return [
            "msg" => "Вы разлогинились"
        ];
    }
}