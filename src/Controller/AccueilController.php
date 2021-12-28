<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\SearchAuteurType;
use App\Form\SearchGenreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager=$entityManager;
    }

    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        $form = $this->createForm(SearchGenreType::class);
        $form2 = $this->createForm(SearchAuteurType::class);

        $repo = $this->entityManager->getRepository(Livre::class);
        $livres = $repo->findAll();

        return $this->render('accueil/index.html.twig', [
            'livres' => $livres,
            'form'=>$form->createView(),
            'form2'=>$form2->createView()
        ]);
    }


}
