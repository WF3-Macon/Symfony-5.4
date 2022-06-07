<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/', name: 'accueil')]
    public function accueil(): Response
    {
        // Code à exécuter
        $variable = 'test';
        $brouette = 'brouette';

        $users = [
            'John', 'Johnny', 'Jonas', 'Jean'
        ];

        dump($users); // Affiche dans la barre de debug
        // dd($users) // Affiche et arrête le code

        // Dernière position
        // JAMAIS RIEN EN DESSOUS
        return $this->render('home/accueil.html.twig', [
            'variable' => $variable,
            'brouette' => $brouette,
            'age' => 40,
            'users' => $users
        ]);
    }
}
