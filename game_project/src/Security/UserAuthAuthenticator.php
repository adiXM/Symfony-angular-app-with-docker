<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface ;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider;

class UserAuthAuthenticator extends AbstractGuardAuthenticator
{
    private $passwordEncoder;
    private $security;
    private $serializer;

    public function __construct(UserPasswordEncoderInterface  $passwordEncoder, Security $security,  SerializerInterface $serializer)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->security = $security;
        $this->serializer = $serializer;
    }

    public function supports(Request $request)
    {
        ///$this->security->
        //print_r($request->getSession());
        //die();
        //$this->security->
        //$request->getSession()->setId("4714deee579e8362ff15a559904d9996");
        //die();
        //$token = new UsernamePasswordToken($user, null, 'secured_area', $user->getRoles());
        if ($this->security->getUser()) {
            return false;
        }
        return $request->get("_route") === "app_login" && $request->isMethod("GET");
    }

    public function getCredentials(Request $request)
    {
        return [
            'username' => $request->get("username"),
            'password' => $request->get("password")
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['username']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([
            'error' => $exception->getMessageKey()
        ], 400);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {

        $session = $request->getSession();

        $userName = $this->security->getUser()->getUsername();
        return (new JsonResponse())->setContent($this->serializer->serialize([$userName, $session], 'json'));
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([
            'error' => 'Access Denied'
        ]);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
