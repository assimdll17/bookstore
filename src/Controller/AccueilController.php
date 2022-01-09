<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Livre;
use App\Form\SearchAuteurType;
use App\Form\SearchGenreType;
use App\Form\SearchMotCleType;
use App\Form\SearchNoteType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager=$entityManager;
    }

    #[Route('/', name: 'accueil')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $livres = $this->entityManager->getRepository(Livre::class)->findAll();


        $search = new Search();       $search2 = new Search();

        $formGenre = $this->createForm(SearchGenreType::class, $search);
        $formAuteur = $this->createForm(SearchAuteurType::class, $search2);
        $formMC = $this->createForm(SearchMotCleType::class, $search);
        $formNote = $this->createForm(SearchNoteType::class, $search);



        $formGenre->handleRequest($request);
        if($formGenre->isSubmitted() && $formGenre->isValid()){
            $livres = $this->entityManager->getRepository(Livre::class)->findWithSearchGenre($search);
        }


        $formMC->handleRequest($request);
        if($formMC->isSubmitted() && $formMC->isValid()){
            $livres = $this->entityManager->getRepository(Livre::class)->findWithSearchMC($search);
        }


        $formNote->handleRequest($request);
        if($formNote->isSubmitted() && $formNote->isValid()){
            $livres = $this->entityManager->getRepository(Livre::class)->findWithSearchNote($search);
        }

        $formAuteur->handleRequest($request);
        if ($formAuteur->isSubmitted() && $formAuteur->isValid()){
            $livres = $this->entityManager->getRepository(Livre::class)->findWithSearchAuteur($search2);
        }


        $livrespages = $paginator->paginate($livres,$request->query->getInt('page', 1),15);

        return $this->render('accueil/index.html.twig', [
            'livres' => $livrespages,
            'formGenre'=>$formGenre->createView(),
            'formAuteur'=>$formAuteur->createView(),
            'formMC'=>$formMC->createView(),
            'formNote'=>$formNote->createView()
        ]);
    }


}
