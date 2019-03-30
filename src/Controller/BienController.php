<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Twig\Environment;
class BienController extends AbstractController{

    /**
     * @Route("/biens", name="catalogue.index")
     * @return Response
     */
    public function index(): Response {
        //return new Response('Liste des biens en vente');
        return $this->render('bien/index.html.twig', [
            'current_menu' => 'catalogue'
            ]
        );
    }
}