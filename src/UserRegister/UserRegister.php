<?php

namespace App\UserRegister;

use App\Entity\User;
use App\UserRegister\Adapter\UserRegisterInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegister implements UserRegisterInterface
{
    public function __construct(private ManagerRegistry $manager_registry, private UserPasswordHasherInterface $hasher)
    {
    }

    public function register(array $params): void
    {
        $user = new User();
        $manager = $this->manager_registry->getManager();
        $user->setEmail($params["email"])
            ->setRoles(["ROLE_USER"])
            ->setPassword($this->hashPassword($params["password"], $user));
        $manager->persist($user);
        $manager->flush();
    }

    private function hashPassword(string $password, object $user)
    {
        return $this->hasher->hashPassword(
            $user,
            $password
        );
    }
}