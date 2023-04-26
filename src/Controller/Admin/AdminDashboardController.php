<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Themes;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $countThemes = $entityManager->getRepository(Themes::class)->getTotalThemes();
        $countArticles = $entityManager->getRepository(Articles::class)->getTotalArticles();
        $countUsers= $entityManager->getRepository(User::class)->getTotalUser();

        return $this->render('Admin/dashboard/index.html.twig', [
            'current_menu' => 'dashboard',
            'themes' => $countThemes,
            'articles' => $countArticles,
            'users' => $countUsers
        ]);
    }
}
