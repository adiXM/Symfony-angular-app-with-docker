<?php

namespace App\Controller;

use App\Entity\User;
use App\Events\NewGameEvent;
use App\Service\ValidatorService;
use GameListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Service\GamesService;
use App\Entity\Game;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class GameController extends AbstractController
{

    private $serializer;
    private $gamesService;
    private $tokenStorage;
    private $passwordEncoder;
    private $dispatcher;
    private $validator;
    public function __construct(GamesService $gamesService,
                                SerializerInterface $serializer,
                                TokenStorageInterface $tokenStorage,
                                UserPasswordEncoderInterface $passwordEncoder,
                                EventDispatcherInterface $dispatcher,
                                ValidatorService $validator)
    {
        $this->serializer = $serializer;
        $this->gamesService = $gamesService;
        $this->tokenStorage = $tokenStorage;
        $this->passwordEncoder = $passwordEncoder;
        $this->dispatcher = $dispatcher;
        $this->validator = $validator;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        return new Response("<html><body>Debug data</body></html>".$request->getSession()->getId());
    }
    /**
     * @Route("api/get_games", name="get_games", methods={"GET"})
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
     * @Route("api/get_game/{id}", name="get_game", methods={"GET"})
     */
    public function getGame($id) : Response
    {
        $outputGame = $this->gamesService->getGame($id);
        return (new JsonResponse())->setContent($this->serializer->serialize($outputGame, 'json'));
    }
    /**
     * @Route("api/update_game/{id}", name="update_game", methods={"POST"})
     */
    public function updateGame($id, Request $request) : Response
    {
        $params = $request->request->all();
        foreach ($params as $value) {
            if(!$this->validator->validate($value)) {
                return new Response($this->validator->getViolationsMessage());
            }
        }
        $this->gamesService->updateGame($id, $params);
        return (new JsonResponse())->setContent($this->serializer->serialize($request, 'json'));
    }
    /**
     * @Route("api/new_game", name="new_game", methods={"POST"})
     */
    public function newGame(Request $request) : Response
    {
        $params = $request->request->all();
        foreach ($params as $value) {
            if(!$this->validator->validate($value)) {
                return new Response($this->validator->getViolationsMessage());
            }
        }
        $game = new Game();
        $game->setName($params['name']);
        $game->setDescription($params["description"]);
        $game->setStore($params["store"]);

        //I will generate a random value for number of players
        $event = new NewGameEvent($game);
        $listener = new GameListener();
        $this->dispatcher->addListener(NewGameEvent::NAME, array($listener, 'onCreatedNewGameAction'));
        $this->dispatcher->dispatch($event, NewGameEvent::NAME);

        $this->gamesService->newGame($game);

        return (new JsonResponse())->setContent($this->serializer->serialize($params, 'json'));
    }
    /**
     * @Route("api/generate_data", name="generate_data", methods={"GET"})
     */
    public function generateDummyData(Request $request) : Response
    {
        //generate admin user to make tests
        $user = new User();
        $user->setUsername("administrator");
        $user->setPassword($this->passwordEncoder->encodePassword($user,"123456"));
        $user->setRoles(["ROLE_ADMIN"]);
        $this->gamesService->insertDummyData($user);
        return (new JsonResponse())->setContent($this->serializer->serialize("success", 'json'));
    }
}
