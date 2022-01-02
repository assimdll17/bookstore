<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Livre;
use App\Form\SearchAuteurType;
use App\Form\SearchGenreType;
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



        $search = new Search();
        $formGenre = $this->createForm(SearchGenreType::class, $search);
        $formAuteur = $this->createForm(SearchAuteurType::class, $search);

        $formGenre->handleRequest($request);
        $formAuteur->handleRequest($request);
        if($formGenre->isSubmitted() && $formGenre->isValid()){
            $livres = $this->entityManager->getRepository(Livre::class)->findWithSearchGenre($search);
        }
        elseif ($formAuteur->isSubmitted() && $formAuteur->isValid()){
            $livres = $this->entityManager->getRepository(Livre::class)->findWithSearchAuteur($search);
        }
        else{
            $livres = $this->entityManager->getRepository(Livre::class)->findAll();
        }



        $livrespages = $paginator->paginate($livres,$request->query->getInt('page', 1),20);

        return $this->render('accueil/index.html.twig', [
            'livres' => $livrespages,
            'formGenre'=>$formGenre->createView(),
            'formAuteur'=>$formAuteur->createView()
        ]);
    }


}
