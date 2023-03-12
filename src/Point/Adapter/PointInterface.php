<?php


namespace App\Point\Adapter;


interface PointInterface
{
    public function getUserPoints($email): array;
}