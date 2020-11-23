<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class PlayersService
{
    private $em;
    private $players;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->players = array();
    }
   public function getNoPlayers(){

   }
}