<?php

namespace App\UserRegister\Adapter;

interface UserRegisterInterface 
{
    public function register(array $params): void;
}