<?php

namespace App\Controller\Admin;

use App\Entity\Themes;
use App\Form\ThemesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminThemesController extends AbstractController
{
    #[Route('/admin/themes', name: 'admin_themes')]
    public function index(): Response
    {
        return $this->render('Admin/themes/index.html.twig', [
            'current_menu' => 'themes',
        ]);
    }

    #[Route('/admin/themes/ajout', name: 'admin_themes_create')]
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $theme = new Themes();
        $form = $this->createForm(ThemesType::class, $theme);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($theme);
            $entityManager->flush();
            $this->addFlash('succes_theme_create', 'Votre thème a bien été créer');
            return $this->redirectToRoute('admin_themes');
        }

        return $this->render('Admin/themes/new.html.twig', [
            'current_menu' => "themes",
            'themeForm' => $form->createView()
        ]);
    }
}
