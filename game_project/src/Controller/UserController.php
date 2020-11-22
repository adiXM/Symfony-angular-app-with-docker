<?php

namespace App\Controller;

use App\Service\GamesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    private $security;
    private $serializer;
    public function __construct(Security $security, SerializerInterface $serializer)
    {
        $this->security = $security;
        $this->serializer = $serializer;
    }

    /**
     * @Route("login", name="app_login", methods={"GET"})
     */
    public function login(Request $request) : Response
    {
        return $this->getUserData($request);
    }
    /**
     * @Route("logout", name="app_logout", methods={"GET"})
     */
    public function logout(Request $request)
    {

    }
    /**
     * @Route("/user", name="user")
     */
    public function index(TokenInterface $token): Response
    {
        return new Response("<html><body>Debug data</body></html>".$token);
    }
    /**
     * @Route("/api/get_user", name="get_user", methods={"GET"})
     */
    public function getUserData(Request $request): Response
    {

        $userName = $this->security->getUser()->getUsername();
        $data = $this->serializer->serialize([$userName, $request->getSession()->getId()], 'json');
        $response =  (new Response($data, 200));
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set("Access-Control-Allow-Credentials", "true");

        return $response;
    }
}
