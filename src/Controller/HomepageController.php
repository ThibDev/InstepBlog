<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * Permet d'afficher la page d'accueil du site
     * @return Response
     */
    #[Route('/', name: 'homepage')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $lastArticle = $entityManager->getRepository(Articles::class)->findLastArticles(1);
        $article = $entityManager->getRepository(Articles::class)->findAll();

        return $this->render('homepage/index.html.twig', [
            'current_menu' => 'homepage',
            'lastArticles' => $lastArticle,
            'articles' => $article
        ]);
    }
}
