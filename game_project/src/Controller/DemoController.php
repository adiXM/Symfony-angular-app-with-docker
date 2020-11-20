<?php

namespace App\Controller;

use App\Entity\Game;
use App\Service\DemoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class DemoController extends AbstractController
{
    /**
     * @Route("/demo", name="demo_list")
     */
    public function index(DemoService $messageGenerator)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $game = new Game();
        $game->setName("Nume joc");
        $game->setDescription("Descriere joc");
        $game->setStore("Magazin");
        $entityManager->persist($game);
        $entityManager->flush();

        return new Response('Saved new game with id '.$game->getId());
    }
}