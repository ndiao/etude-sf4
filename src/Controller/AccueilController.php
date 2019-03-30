<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Twig\Environment;

class AccueilController extends  AbstractController{

    
    /**
     * @var Environment
     */
    /*private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }
    */
    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function index(): Response {
        //return new Response($this->twig->render('pages/accueil.html.twig'));
        return $this->render('pages/accueil.html.twig');
    }
}