<?php


namespace App\Controller;

use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/administrer/pointDeVente', name: 'manage_store', methods: ['GET'])]
    public function index(StoreRepository $storeRepository): Response
    {
        $stores = $storeRepository->findBy([], ['name' => 'ASC']);

        return $this->render('admin/manage_store.html.twig', [
            'stores' => $stores,
        ]);
    }

    #[Route('/administrer/vendeur', name: 'manage_seller', methods: ['GET'])]
    public function indexUser(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy([], ['lastname' => 'ASC']);
        return $this->render('admin/manage_seller.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/consulter/pointDeVente', name: 'table_store', methods: ['GET'])]
    public function tablestore(StoreRepository $storeRepository): Response
    {
        $stores = $storeRepository->findBy([], ['name' => 'ASC']);

        return $this->render('admin/table_store.html.twig', [
            'stores' => $stores,
        ]);
    }

    #[Route('/consulter/vendeur', name: 'table_seller', methods: ['GET'])]
    public function tableUser(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy([], ['lastname' => 'ASC']);
        return $this->render('admin/manage_seller.html.twig', [
            'users' => $users,
        ]);
    }
}
