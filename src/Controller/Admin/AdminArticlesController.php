<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticlesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticlesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/articles', name: 'admin_articles')]
    public function index(): Response
    {
        $articles = $this->entityManager->getRepository(Articles::class)->findAll();

        return $this->render('Admin/articles/index.html.twig', [
            'current_menu' => 'articles',
            'articles' => $articles
        ]);
    }

    #[Route('/admin/articles/ajout', name: 'admin_articles_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): RedirectResponse|Response
    {
        $article = new Articles();
        $form= $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On gère la date de création
            $dateTimeZone = new \DateTimeZone('Europe/Paris');
            $date = new \DateTimeImmutable('now', $dateTimeZone);
            $article->setCreatedAt($date);

            $this->entityManager->persist($article);
            $this->entityManager->flush();

            $this->addFlash(
                'success_articles_create',
                'L\'article a bien été enregistré !'
            );

            return $this->redirectToRoute('admin_articles');
        }

        return $this->render('Admin/articles/new.html.twig', [
            'articleForm' => $form->createView(),
            'current_menu' => 'article'
        ]);
    }

    #[Route('/admin/articles/modifier/{slug}', name: 'admin_articles_edit')]
    public function edit(Articles $articles, Request $request, $slug)
    {
        $article = $this->entityManager->getRepository(Articles::class)->findOneBySlug($slug);

        $form = $this->createForm(ArticlesType::class, $articles);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlash('success_article_edit', 'Le thème a bien été modifié');
            return $this->redirectToRoute('admin_articles');
        }

        return $this->render('Admin/articles/edit.html.twig', [
            'article' => $article,
            'current_menu' => "articles",
            'articleForm' => $form->createView()
        ]);
    }

    #[Route('/admin/articles/supprimer/{slug}', name: 'admin_articles_delete')]
    public function delete(Articles $articles)
    {
        $this->entityManager->remove($articles);
        $this->entityManager->flush();
        $this->addFlash('success_theme_delete', 'Le thèeme a bien été modifié');
        return $this->redirectToRoute('admin_articles');
    }
}