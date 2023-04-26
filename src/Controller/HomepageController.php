<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
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
    public function index(ArticlesRepository $articlesRepository): Response
    {
        $article = $articlesRepository->findBy(array(), array('id' => 'desc'), 1);
        return $this->render('homepage/index.html.twig', [
            'current_menu' => 'homepage',
            'articles' => $article
        ]);
    }
}
