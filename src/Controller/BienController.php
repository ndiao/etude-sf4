<?php
namespace App\Controller;

use App\Entity\Bien;

use App\Repository\BienRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Common\Persistence\ObjectManager;

use Twig\Environment;

use Knp\Component\Pager\PaginatorInterface;

use Symfony\Component\HttpFoundation\Request;

use App\Payload\BienSearch;
use App\Form\BienSearchType;


class BienController extends AbstractController{

    /**
     * @var BienRepository
     */
    private $bienRepo;

    private $em;

    public function __construct(BienRepository $bienRepo, ObjectManager $em){
        $this->bienRepo = $bienRepo;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="catalogue.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response {
        //return new Response('Liste des biens en vente');

        /* Ajout d'un nouveau bien
        $bien = new Bien();
        $bien->setNom('Villa grand standing')
            ->setDescription('Villa pieds dans l\'eau')
            ->setSurface(1234)
            ->setPieces(8)
            ->setChambres(6)
            ->setEtage(2)
            ->setClimatisation(1)
            ->setVille('Dakar')
            ->setAdresse('Fann Residence, villa N° 123');

        $em = $this->getDoctrine()->getManager();
        $em->persist($bien);
        $em->flush();
        */
        /* Récuperation du bien ajouté */
        /*$repo = $this->getDoctrine()->getRepository(Bien::class);
        dump($repo);*/
        /*$bien = $this->bienRepo->findOneBy(['climatisation' => 1]);
        dump($bien);*/
        //$biens = $this->bienRepo->findAllEnVente();
       /* $biens[0]->setVendu(true);
        
        $this->em->flush();*/
        //dump($biens);
        $bienSearch = new BienSearch();
        $form = $this->createForm(BienSearchType::class, $bienSearch);
        $form->handleRequest($request);

        $biens = $paginator->paginate(
                        $this->bienRepo->findAllEnVenteQuery($bienSearch),
                        $request->query->getInt('page', 1), /*page number*/
                        12 /*limit per page*/
        );
        return $this->render('bien/index.html.twig', [
            'current_menu' => 'catalogue',
            'biens_en_vente' => $biens,
            'form'          => $form->createView()
            ]
        );
    }
    /**
     * @Route("/bien/{slug}-{id}", name="bien.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Bien $bien, string $slug): Response {
        //$bien = $this->bienRepo->find($id);
        if($bien->getSlug() !== $slug) {
            return $this->redirectToRoute('bien.show', [
                'id' => $bien->getId(),
                'slug' => $bien->getSlug()
            ], 301);
        }
        return $this->render('bien/show.html.twig', [
            'bien' => $bien
            ]
        );
    }
}