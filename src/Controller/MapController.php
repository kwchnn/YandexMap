<?php

namespace App\Controller;

use App\Entity\Map;
use App\Form\Form;
use App\Repository\MapRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class MapController extends AbstractController
{
    #[Route('/point_edit/{id}', name: 'app_map_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Map $map, MapRepository $mapRepository): Response
    {
        $form = $this->createForm(Form::class, $map);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mapRepository->save($map, true);

            return $this->redirectToRoute('user_main_page', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('map/edit.html.twig', [
            'map' => $map,
            'form' => $form,
        ]);
    }

    #[Route('/point_delete/{id}', name: 'map_delete', methods: ['GET','POST'])]
    public function delete(Request $request, Map $map, MapRepository $mapRepository): Response
    {
        $mapRepository->remove($map, true);
        return $this->redirectToRoute('user_main_page', [], Response::HTTP_SEE_OTHER);
    }
}
