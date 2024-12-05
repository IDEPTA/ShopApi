<?php

namespace App\Repository;

use DateTime;
use Carbon\Carbon;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

use function PHPSTORM_META\type;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    private $entityManager;
    private $passwordHasher;
    private $validator;

    public function __construct(
        ManagerRegistry $registry,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        parent::__construct($registry, User::class);
    }

    public function register(array $data)
    {
        // Создаем объект User

        $user = new User();
        $user->setName($data['name']);
        $user->setLastname($data['lastname']);
        $user->setPatronymic($data['patronymic']);
        $user->setEmail($data['email']);
        $user->setPhone($data['phone']);
        $user->setBirthDate(new \DateTime($data['birth_date']));
        $user->setPassword($this->passwordHasher->hashPassword($user, $data['password']));
        $user->setCreatedAt(Carbon::now());
        $user->setUpdatedAt(Carbon::now());

        $errors = $this->validator->validate($user);
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
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Возвращаем успешный ответ
        return $user;
    }
    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}