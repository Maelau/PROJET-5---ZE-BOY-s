<?php

namespace App\Controller;

use App\Entity\Client;  // Assure-toi que cette ligne est présente pour l'entité Client
use App\Repository\ClientRepository;  // Le Repository pour interagir avec la base de données
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ClientController extends AbstractController
{
    #[Route('/client', name: 'app_client_index')]
    public function index(ClientRepository $clientRepository): Response
    {
        // Récupère tous les clients depuis la base de données
        $clients = $clientRepository->findAll();

        // Passe la variable 'clients' à la vue Twig
        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }
}
