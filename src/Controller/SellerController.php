<?php

namespace App\Controller;

use App\Entity\Sale;
use App\Form\SaleType;
use App\Repository\SaleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class SellerController extends AbstractController
{
    #[Route('/vendeur', name: 'app_home_seller')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {

        $seller = $this->getuser();

        return $this->render('seller/index.html.twig', [
            'seller' => $seller,
        ]);
    }

    #[Route('/vendeur/nouvelle-vente', name: 'app_newSale')]
    public function newSale(Request $request, SaleRepository $saleRepository): Response
    {
        $seller = $this->getUser();

        $sale = new Sale();

        // Créer le formulaire de création de vente
        $form = $this->createForm(SaleType::class, $sale);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sale->setSeller($seller);

            // Enregistrer la vente en base de données en utilisant le SaleRepository
            $saleRepository->save($sale);
            $this->addFlash('success', 'Votre vente a bien été enregistrée');

            // Rediriger vers une autre page après la création de la vente
            return $this->redirectToRoute('app_home_seller');
        }

        return $this->render('seller/newSale.html.twig', [
            'form' => $form->createView(),
            'seller' => $seller,
        ]);
    }

    #[Route('/vendeur/facture', name: 'app_invoice')]
    public function invoice(): Response
    {
        // TODO: Add logic for the invoice page
        // For example, display the list of invoices for the seller
        return $this->render('seller/invoice.html.twig');
    }

    #[Route('/vendeur/archives-ventes', name: 'app_sales_archive')]
    public function salesArchive(SaleRepository $saleRepository): Response
    {
        $user = $this->getUser();
        $sales = $saleRepository->findBy(
            ['seller' => $user],
            ['saleDate' => 'ASC']
        );

        $totalRevenue = 0;
        foreach ($sales as $sale) {
            $totalRevenue += (float)$sale->getRevenue();
        }

        $totalQuantity = 0;
        foreach ($sales as $sale) {
            $totalQuantity += $sale->getQuantity();
        }

        return $this->render('seller/sales_archive.html.twig', [
            'sales' => $sales,
            'seller' => $user,
            'totalRevenue' => $totalRevenue,
            'totalQuantity' => $totalQuantity,

        ]);
    }
}
