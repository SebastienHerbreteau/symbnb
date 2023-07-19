<?php

namespace App\Controller;

use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="homepage")
     */
    public function home(AdRepository $repo)
    {

        $ads = $repo->findBy([], ['price' => 'DESC'], 3);
        return $this->render('home.html.twig', [
            'ads' => $ads,
        ]);
    }
}
