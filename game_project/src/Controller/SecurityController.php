<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("login", name="app_login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $parametersAsArray = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        return $this->json([
            //'user' => $this->getUser() ? $this->getUser()->getId() : null]
            'result' => $parametersAsArray]
        );
    }
}