<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
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
