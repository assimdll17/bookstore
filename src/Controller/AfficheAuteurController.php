<?php

namespace App\Controller;

use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficheAuteurController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/affiche/auteur/{id}', name: 'affiche_auteur')]
    public function index($id): Response
    {
        $auteur = $this->entityManager->getRepository(Auteur::class)->findOneById($id);


        return $this->render('affiche_auteur/index.html.twig', [
            'auteur' => $auteur,
        ]);
    }
}
