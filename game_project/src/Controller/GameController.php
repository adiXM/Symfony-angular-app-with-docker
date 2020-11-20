<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Service\GamesService;
use App\Entity\Game;


class GameController extends AbstractController
{

    private $serializer;
    private $gamesService;

    public function __construct(GamesService $gamesService, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        $this->gamesService = $gamesService;
    }
    /**
     * @Route("api/get_games", name="get_games")
     */
    public function getGames(): Response
    {
        $games = $this->gamesService->getAllGames();
        return (new JsonResponse())->setContent($this->serializer->serialize($games, 'json'));
    }
    /**
     * @Route("api/remove_game/{id}", name="remove_game")
     */
    public function removeGame($id) : Response
    {
        $this->gamesService->removeGame($id);
        return new Response();
    }
    /**
     * @Route("api/get_game/{id}", name="get_game")
     */
    public function getGame($id) : Response
    {
        $outputGame = $this->gamesService->getGame($id);
        return (new JsonResponse())->setContent($this->serializer->serialize($outputGame, 'json'));
    }
    /**
     * @Route("api/update_game/{id}", name="update_game")
     */
    public function updateGame($id, Request $request) : Response
    {
        //$this->gamesService->updateGame($id, $request);
        return (new JsonResponse())->setContent($this->serializer->serialize($request, 'json'));
    }
}
