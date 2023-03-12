<?php

namespace App\Controller;

use App\UserRegister\Adapter\UserRegisterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserRegisterController extends AbstractController
{
    #[Route('/register', name: 'user_register_form')]
    public function registerFormAction(Request $request)
    {
        if ($this->getUser())
        {
            return $this->redirectToRoute('user_main_page');
        }
        return $this->render('security/user_register.html.twig');
    }

    #[Route('/register_user', name: 'user_register')]
    public function registerAction(Request $request, UserRegisterInterface $register)
    {
        if ($this->getUser())
        {
            return $this->redirectToRoute('user_main_page');
        }
        $register->register($request->request->all());
        return $this->redirectToRoute('app_login');
    }

}