<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    #[Route('/mon-compte/modifier-mot-de-passe', name: 'account_password')]
    public function index(Request $request, UserPasswordHasherInterface $encoder, EntityManagerInterface $entityManager): Response
    {
        if ($user = $this->getUser()){
            $form = $this->createForm(ChangePasswordType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $old_password = $form->get('old_password')->getData();
                if ($encoder->isPasswordValid($user, $old_password)) {
                    $new_password = $form->get('new_password')->getData();
                    $password = $encoder->hashPassword($user, $new_password);

                    /**
                     * @var User $user
                     */
                    $user->setPassword($password);
                    $entityManager->flush();
                    $this->addFlash('update_password_succes', 'Votre nouveau mot de passe a bien été enregistrer');
                    return $this->redirectToRoute('account');
                }
            }else{
                $this->addFlash('error_update_password', 'Votre mot de passe actuel n\'est pas le bon');
            }
        }else {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('account/password.html.twig', [
            'current_menu' => 'homepage',
            'updatePasswordForm' => $form->createView()
        ]);
    }
}
