<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GamificationController extends AbstractController
{
    #[Route('/points', name: 'app_points')]
public function index(): Response
{
    $points = [
        ['quete' => 'Quête 1', 'points' => 5],
        ['quete' => 'Quête 2', 'points' => 10],
    ];

    $badges = [
        ['nom' => 'Débutant', 'description' => 'Attribué pour 10 quêtes accomplies'],
        ['nom' => 'Explorateur', 'description' => 'Attribué pour 50 quêtes accomplies'],
    ];

    return $this->render('gamification/index.html.twig', [
        'points' => $points,
        'badges' => $badges,
    ]);
}
}
