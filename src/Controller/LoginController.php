<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($this->getUser()) {
            $roles = $this->getUser()->getRoles();

            // Rediriger l'utilisateur vers la page appropriée en fonction de ses rôles
            if (in_array('ROLE_USER', $roles)) {
                return $this->redirectToRoute('app_home_seller');
            } elseif (in_array('ROLE_ADMIN', $roles)) {
                // Redirection vers la page admin à définir
                return $this->redirectToRoute('app_newSale');
            }
        }

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
