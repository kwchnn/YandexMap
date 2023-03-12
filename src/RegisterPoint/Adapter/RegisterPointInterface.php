<?php


namespace App\RegisterPoint\Adapter;


interface RegisterPointInterface
{
    public function getFormParams($params, $user_email);
}