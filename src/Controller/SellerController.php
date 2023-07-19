<?php

namespace App\Controller;

use App\Entity\Sale;
use App\Form\SaleType;
use App\Repository\SaleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class SellerController extends AbstractController
{
    #[Route('/vendeur', name: 'home_seller')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {

        $seller = $this->getuser();

        return $this->render('seller/index.html.twig', [
            'seller' => $seller,
        ]);
    }

    #[Route('/vendeur/nouvelle-vente', name: 'newSale')]
    public function newSale(Request $request, SaleRepository $saleRepository): Response
    {
        $sale = new Sale();

        // Créer le formulaire de création de vente
        $form = $this->createForm(SaleType::class, $sale);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer la vente en base de données en utilisant le SaleRepository
            $saleRepository->save($sale);


            // Rediriger vers une autre page après la création de la vente
            return $this->redirectToRoute('home_seller');
        }

        return $this->render('seller/newSale.html.twig', [
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
