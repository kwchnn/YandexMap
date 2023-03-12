<?php


namespace App\RegisterPoint\Adapter;


interface RegisterPointInterface
{
    public function getFormParams(object $params, string $user_email): void;
}