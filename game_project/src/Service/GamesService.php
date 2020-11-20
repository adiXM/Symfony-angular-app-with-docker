<?php

namespace App\Service;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;

class GamesService
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
    public function getAllGames(): array
    {
        return $this->em->getRepository(Game::class)->findAll();
    }
    public function removeGame($id)
    {
        $myGame = $this->em->getRepository(Game::class)->find($id);
        $this->em->remove($myGame);
        $this->em->flush();
    }
    public function getGame($id)
    {
        return $this->em->getRepository(Game::class)->find($id);
    }
    public function updateGame($id, $request)
    {
        print_r($request);
        header("Access-Control-Allow-Origin: *");
        $myGame = $this->em->getRepository(Game::class)->find($id);
        if(!$myGame) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $myGame->setName("test");
        $this->em->flush();

    }
}