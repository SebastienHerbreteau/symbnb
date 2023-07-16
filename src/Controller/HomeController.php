<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/hello/{prenom}/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{prenom}", name="hello_prenom")
     * Montre la page qui dit bonjour
     * @param string $prenom
     * @param string $age
     * @return Response
     */
    public function hello($prenom ="no name", $age ="pas d'age")
    {

     return $this->render(
         'hello.html.twig',
        [
            'prenom' => $prenom,
            'age' => $age
        ]
    );
            }

    /**
     * @Route("/", name="homepage")
     */
    public function home()
    {
        $prenoms = ["Joseph" => 51, "Jean" => 32, "Henri" => 67];
        return $this->render(
            'home.html.twig',
            [
                'title' => "Bonjour à tous",
                'age' => 12,
                'tableau' => $prenoms
            ]
        );
    }
}
