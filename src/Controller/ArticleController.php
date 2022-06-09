<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use DateTimeImmutable;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'article' => $articleRepository->find(4),
            'post' => $articleRepository->findOneBy(['title' => 'Titre_7'], ['created_at' => 'DESC']),
            'posts' => $articleRepository->findBy(['created_at' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-06-08 08:23:03')]),
            'results' => $articleRepository->findByTitleOrDescription('Titre_122', 'Description_200')
        ]);
    }

    #[Route('/article/relation', name: 'app_article_relation')]
    public function relations(): Response
    {
        return $this->render('article/relations.html.twig');
    }
}