<?php

namespace App\Controller;

use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficheLivreController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/affiche/livre/{id}', name: 'affiche_livre')]
    public function index($id): Response
    {

        $livre = $this->entityManager->getRepository(Livre::class)->findOneById($id);
        return $this->render('affiche_livre/index.html.twig', [
            'livre' => $livre,
        ]);
    }
}
