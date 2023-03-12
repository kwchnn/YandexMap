<?php


namespace App\Point\Adapter;


interface PointInterface
{
    public function getUserPoints(string $email): array;
}