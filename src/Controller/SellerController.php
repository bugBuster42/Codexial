<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class SellerController extends AbstractController
{
    #[Route('/vendeur', name: 'home_seller')]
    public function index(): Response
    {
        // Vérifiez si l'utilisateur est connecté
        if (!$this->getUser()) {
            throw new AccessDeniedException('Vous devez être connecté en tant que vendeur pour accéder à cette page.');
        }

        $seller = $this->getuser();

        return $this->render('seller/index.html.twig', [
            'seller' => $seller,
        ]);
    }

    #[Route('/vendeur/nouvelle-vente', name: 'new_sale')]
    public function newSale(Request $request): Response
    {
        $sale = new Sale();

        // Créer le formulaire de création de vente
        $form = $this->createForm(NewSaleType::class, $sale);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traiter les données du formulaire (par exemple, enregistrer la vente en base de données)

            // Rediriger vers une autre page après la création de la vente
            return $this->redirectToRoute('sales_archive');
        }

        return $this->render('seller/new_sale.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/vendeur/facture', name: 'invoice')]
    public function invoice(): Response
    {
        // TODO: Add logic for the invoice page
        // For example, display the list of invoices for the seller
        return $this->render('seller/invoice.html.twig');
    }

    #[Route('/vendeur/archives-ventes', name: 'sales_archive')]
    public function salesArchive(): Response
    {
        // TODO: Add logic for the sales archive page
        // For example, display the list of archived sales for the seller
        return $this->render('seller/sales_archive.html.twig');
    }
}
