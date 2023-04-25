<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
