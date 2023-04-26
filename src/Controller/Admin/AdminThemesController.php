<?php

namespace App\Controller\Admin;

use App\Entity\Themes;
use App\Form\ThemesType;
use App\Repository\ThemesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminThemesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/admin/themes', name: 'admin_themes')]
    public function index(): Response
    {
        $themes = $this->entityManager->getRepository(Themes::class)->findAll();

        return $this->render('Admin/themes/index.html.twig', [
            'current_menu' => 'themes',
            'themes' => $themes
        ]);
    }

    #[Route('/admin/themes/ajout', name: 'admin_themes_create')]
    public function create(Request $request)
    {
        $theme = new Themes();
        $form = $this->createForm(ThemesType::class, $theme);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($theme);
            $this->entityManager->flush();
            $this->addFlash('success_themes_create', 'Votre thème a bien été créer');
            return $this->redirectToRoute('admin_themes');
        }

        return $this->render('Admin/themes/new.html.twig', [
            'current_menu' => "themes",
            'themeForm' => $form->createView()
        ]);
    }

    #[Route('/admin/themes/modifier/{slug}', name: 'admin_themes_edit')]
    public function edit(Themes $themes, Request $request, $slug)
    {
        $theme = $this->entityManager->getRepository(Themes::class)->findOneBySlug($slug);

        $form = $this->createForm(ThemesType::class, $themes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlash('success_themes_edit', 'Le thème a bien été modifié');
            return $this->redirectToRoute('admin_themes');
        }

        return $this->render('Admin/themes/edit.html.twig', [
            'theme' => $theme,
            'current_menu' => "themes",
            'themeForm' => $form->createView()
        ]);
    }

    #[Route('/admin/themes/supprimer/{slug}', name: 'admin_themes_delete')]
    public function delete(Themes $themes)
    {
        $this->entityManager->remove($themes);
        $this->entityManager->flush();
        $this->addFlash('success_themes_delete', 'Le thème a bien été modifié');
        return $this->redirectToRoute('admin_themes');
    }
}
