<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    #[Route('/mon-compte/modifier-mot-de-passe', name: 'account_password')]
    public function index(): Response
    {
        return $this->render('account/passeword.html.twig', [
            'current_menu' => 'homepage',
        ]);
    }
}
