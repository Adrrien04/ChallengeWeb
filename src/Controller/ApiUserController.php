<?php
// filepath: /Users/oumoukeirouc./Documents/my-api-dailyquest/src/Controller/ApiUserController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiUserController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/users', name: 'app_user_list')]
    public function userList(): Response
    {
        try {
            $response = $this->client->request('GET', 'https://localhost:8002/api/users', [
                'timeout' => 10,  // Délai plus court pour éviter un timeout trop long
                'verify_peer' => false,  // Désactiver la vérification du certificat SSL
                'verify_host' => false,  // Désactiver la vérification de l'hôte SSL
            ]);

            // Convertir la réponse JSON en tableau
            $data = $response->toArray();

            // Passer les données des utilisateurs à la vue
            return $this->render('user_list.html.twig', [
                'users' => $data['member'],
            ]);
        } catch (\Exception $e) {
            // Gérer les exceptions et retourner une réponse d'erreur
            return new Response('Erreur lors de la récupération des utilisateurs : ' . $e->getMessage(), 500);
        }
    }
}