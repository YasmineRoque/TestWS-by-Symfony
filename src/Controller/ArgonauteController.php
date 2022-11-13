<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Argonaute;
use App\Form\ArgonauteFormType;
use Symfony\Component\HttpFoundation\Request;

class ArgonauteController extends AbstractController
{
    #[Route('/argonaute', name: 'app_argonaute')]
    public function argonaute(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        // Le read
        $repository = $doctrine->getRepository(Argonaute::class);
        $argonautes = $repository->findAll();
        // Le create:
        $argonaute = new Argonaute;
        $argonauteForm = $this->createForm(ArgonauteFormType::class, $argonaute);
        $argonauteForm->handleRequest($request);
        if ($argonauteForm->isSubmitted() && $argonauteForm->isValid()) {
            $em->persist($argonaute);
            $em->flush();
            return $this->redirectToRoute("app_argonaute");
        }


        return $this->render("argonaute/index.html.twig", [
            "argonautes" => $argonautes,
            "dataForm" => $argonauteForm->createView(),
            "formName" => "Argonaute"
        ]);
    }
}
