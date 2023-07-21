<?php

namespace App\Controller;

use App\Entity\Sale;
use App\Form\SaleType;
use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Repository\SaleRepository;
use App\Repository\UserRepository;
use App\Repository\InvoiceRepository;
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


        $form = $this->createForm(SaleType::class, $sale);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sale->setSeller($seller);


            $saleRepository->save($sale);
            $this->addFlash('success', 'Votre vente a bien été enregistrée');


            return $this->redirectToRoute('app_home_seller');
        }

        return $this->render('seller/newSale.html.twig', [
            'form' => $form->createView(),
            'seller' => $seller,
        ]);
    }

    #[Route('/vendeur/facture', name: 'app_invoice')]
    public function invoice(Request $request, InvoiceRepository $invoiceRepository): Response
    {
        $seller = $this->getUser();

        $invoice = new Invoice();

        $form = $this->createForm(InvoiceType::class, $invoice);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $invoice->setSeller($seller);
            $invoiceRepository->save($invoice);
            $this->addFlash('success', 'La facture a été enregistrée avec succès.');
        }
        return $this->render('seller/invoice.html.twig', [
            'form' => $form->createView(),
            'seller' => $seller,
        ]);
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
