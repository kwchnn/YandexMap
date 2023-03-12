<?php


namespace App\RegisterPoint;


use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;

class RegisterPoint implements Adapter\RegisterPointInterface
{

    public function __construct(private ManagerRegistry $manager_registry, private UserRepository $user_repository)
    {}

    public function getFormParams($params, $user_email)
    {
        $user = $this->user_repository->getUserByEmail($user_email);
        $manager = $this->manager_registry->getManager();
        $params->setUserId($user->getId());
        $manager->persist($params);
        $manager->flush();
    }
}