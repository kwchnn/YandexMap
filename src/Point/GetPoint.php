<?php


namespace App\Point;

use App\Point\Adapter\PointInterface;
use App\Repository\MapRepository;
use App\Repository\UserRepository;

class GetPoint implements PointInterface
{

    public function __construct(private UserRepository $user_repository, private MapRepository $map_repository)
    {}

    public function getUserPoints($email): array
    {
        $user = $this->user_repository->getUserByEmail($email);
        return $this->map_repository->findBy(['user_id' => $user->getId()]);
    }
}