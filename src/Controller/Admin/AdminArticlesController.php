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
    #[Route('/admin/articles', name: 'admin_articles')]
    public function index(): Response
    {
        return $this->render('Admin/articles/index.html.twig', [
            'current_menu' => 'articles',
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

            $entityManager->persist($article);
            $entityManager->flush();

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
}