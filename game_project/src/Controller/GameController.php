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
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class GameController extends AbstractController
{

    private $serializer;
    private $gamesService;
    private $tokenStorage;
    public function __construct(GamesService $gamesService, SerializerInterface $serializer, TokenStorageInterface $tokenStorage)
    {
        $this->serializer = $serializer;
        $this->gamesService = $gamesService;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        return new Response("<html><body>Debug data</body></html>".$request->getSession()->getId());
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
        $params = $request->request->all();
        $this->gamesService->updateGame($id, $params);
        return (new JsonResponse())->setContent($this->serializer->serialize($request, 'json'));
    }
    /**
     * @Route("api/new_game", name="new_game", methods={"POST"})
     */
    public function newGame(Request $request) : Response
    {
        $params = $request->request->all();
        $game = new Game();
        $game->setName($params['name']);
        $game->setDescription($params["description"]);
        $game->setStore($params["store"]);
        $this->gamesService->newGame($game);
        return (new JsonResponse())->setContent($this->serializer->serialize($params, 'json'));
    }
}
