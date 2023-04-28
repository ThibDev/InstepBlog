<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * Permet d'afficher la page du blog
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/blog', name: 'blog')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $articles = $entityManager->getRepository(Articles::class)->findAll();
        return $this->render('blog/index.html.twig', [
            'current_menu' => 'blog',
            'articles' => $articles
        ]);
    }

    /**
     * Permet de voir en détail un article
     * @param EntityManagerInterface $entityManager
     * @param $slug
     * @return Response
     */
    #[Route('/blog/article/{slug}', name: 'blog_show')]
    public function show(EntityManagerInterface $entityManager, $slug): Response
    {
        $article = $entityManager->getRepository(Articles::class)->findOneBySlug($slug);
        return $this->render('blog/show.html.twig', [
            'current_menu' => 'blog',
            'article' => $article
        ]);
    }
}