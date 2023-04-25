<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAccountController extends AbstractController
{
    #[Route('/admin/connexion', name: 'admin_account_login')]
    public function index(): Response
    {
        return $this->render('Admin/account/index.html.twig', [
            'current_name' => 'homepage',
        ]);
    }
}
