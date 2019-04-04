<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Repository\BienRepository;

use App\Form\BienType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Common\Persistence\ObjectManager;


use App\Entity\Bien;

class AdminBienController extends AbstractController {

    /**
     * @var BienRepository
     */
    private $bienRepo;

    private $em;

    public function __construct(BienRepository $bienRepo, ObjectManager $em) {
        $this->bienRepo = $bienRepo;
        $this->em = $em;
    }

    /**
     * @Route("/admin/bien/index", name="admin.bien.index")
     * @return Response
     */
    public function index() {
        $biens = $this->bienRepo->findAll();
        //return $this->render('admin/bien/index.html.twig', ['biens' => $biens]);
        return $this->render('admin/bien/index.html.twig', compact('biens'));
    }

    /**
     * @Route("/admin/bien/create", name="admin.bien.new")
     */
    public function new(Request $request) {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($bien);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajouté avec succès');
            return $this->redirectToRoute('admin.bien.index');
        }
        return $this->render('admin/bien/new.html.twig', [
            'bien' => $bien,
            'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/bien/{id}", name="admin.bien.edit", methods="GET|POST")
     * @param Bien $bien
     * @param Request $request
     * @return Response
     */
    public function edit(Bien $bien, Request $request) {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.bien.index');
        }
        return $this->render('admin/bien/edit.html.twig', [
            'bien' => $bien,
            'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/bien/{id}", name="admin.bien.delete", methods="DELETE")
     * @param Bien $bien
     * @return Response
     */
    public function delete(Bien $bien, Request $request) {
        if($this->isCsrfTokenValid('delete' . $bien->getId(), $request->get('_token'))){
            $this->em->remove($bien);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }
        return $this->redirectToRoute('admin.bien.index'); 
    }
}