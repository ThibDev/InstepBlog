<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticlesController extends AbstractController
{
    #[Route('/admin/articles', name: 'app_admin_articles')]
    public function index(): Response
    {
        return $this->render('Admin/articles/index.html.twig', [
            'controller_name' => 'AdminArticlesController',
        ]);
    }
}
