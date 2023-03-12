<?php
namespace App\Controller;


use App\Entity\Map;
use App\Form\Form;
use App\Point\Adapter\PointInterface;
use App\RegisterPoint\Adapter\RegisterPointInterface;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(private UserRepository $repository, private Form $form,
                                private RegisterPointInterface $register_point,
                                private PointInterface $point)
    {}

    #[Route('/user', name: 'user_main_page')]
    public function mainAction(Request $request)
    {
        $map = new Map();
        $form = $this->createForm(Form::class, $map);
        $form->handleRequest($request);
        $points = $this->point->getUserPoints($this->getUser()->getUserIdentifier());
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->register_point->getFormParams($form->getData(), $this->getUser()->getUserIdentifier());
            return $this->redirectToRoute('user_main_page');
        }
        $user = $this->repository->findOneBy(['email' => $this->getUser()->getUserIdentifier()]);
        return $this->render('user/user.html.twig', ['user' => $user, 'form' => $form, 'points' => $points]);
    }
}